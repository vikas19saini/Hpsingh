<?php

namespace App\Controller;

use Cake\Http\Client;

class PagesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->Security->setConfig('unlockedActions', ['save', 'subscribe']);
    }

    public function home()
    {
        $this->loadModel('Sliders');
        $this->loadModel('Products');

        $sliders = $this->Sliders->find('HomePageSliders');
        $mygrams = $this->Sliders->find('Mygram');
        $wholeSales = $this->Sliders->find('Wholesale');

        $deals = $this->Sliders->find('Deals');

        $newArrived = $this->Products->find('NewArrived', ['find' => 'fair'])->limit(20);

        $startDate = (new \DateTime('-1 months'))->format('Y-m-d');
        $endDate = (new \DateTime())->format('Y-m-d');
        $bestSellers = $this->Products->getTopSelling($startDate, $endDate, "yes");

        $page = $this->Pages->find('all', [
            'conditions' => ['is_home' => 'yes']
        ])->first();

        $this->loadModel('Enquiries');
        $contact = $this->Enquiries->newEntity();

        if (!$page) {
            $this->set(compact('sliders', 'newArrived', 'bestSellers', 'contact', 'mygrams', 'wholeSales'));
            $this->render('home'); // Rendering default page
        } else {
            $this->set(compact('sliders', 'newArrived', 'bestSellers', 'page', 'contact', 'mygrams', 'wholeSales', 'deals'));
            $this->render($page->template); // Rendering template set by administrator
        }
    }

    public function staticPage($slug)
    {
        $page = $this->Pages->find('all', [
            'conditions' => ['slug' => $slug],
        ])->first();

        if (!$page) {
            throw new \Cake\Http\Exception\NotFoundException('Page not found.');
        }

        if ($page->is_home === 'yes') {
            return $this->redirect(['_name' => 'home']);
        }

        $this->loadModel('Enquiries');
        $contact = $this->Enquiries->newEntity();

        $this->set(compact('page', 'contact'));
        $this->render($page->template);
    }

    public function save($redirect_slug)
    {
        $this->request->allowMethod(['post']);

        $g_recaptcha_response = $this->request->getData('g-recaptcha-response');

        $http = new Client();
        $response = $http->get("https://www.google.com/recaptcha/api/siteverify?secret=" . env('GOOGLE_CAPTCHA_SECRET') . "&response=$g_recaptcha_response&remoteip=" . $this->request->clientIp());

        if ($response->isOk()) {
            $response = $response->json;
            if (!$response['success']) {
                $this->Flash->error('Captcha couldn\'t be verified.');
                return $this->redirect(['action' => 'staticPage', $redirect_slug]);
            }
        } else {
            $this->Flash->error('Captcha couldn\'t be verified.');
            return $this->redirect(['action' => 'staticPage', $redirect_slug]);
        }

        $this->loadModel('Enquiries');
        $contact = $this->Enquiries->newEntity();

        $formData = $this->request->getData();

        if (isset($formData['tool'])) {
            if (!empty($formData['tool'])) {
                $formData['tool'] = implode(',', $formData['tool']);
            }
        }

        $contact = $this->Enquiries->patchEntity($contact, $formData);

        if ($this->Enquiries->save($contact)) {
            $this->Flash->success('Thanks for submitting your details. Our team shall connect within the next 24 hours.');
        } else {
            $this->Flash->error('Something went wrong, Please try again!');
        }

        if ($redirect_slug === 'home') {
            return $this->redirect(['_name' => 'home']);
        }

        return $this->redirect(['action' => 'staticPage', $redirect_slug]);
    }

    public function subscribe()
    {
        $this->request->allowMethod('ajax');

        $this->loadModel('Subscribers');
        $subscriber = $this->Subscribers->newEntity();
        $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->getData());

        if ($this->Subscribers->save($subscriber)) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'message' => 'subscribed']));
        }

        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Culdn\'t subscribed']));
    }

    public function blogs($slug = 0)
    {
        error_reporting(0);
        $this->loadModel('Stories');

        if (empty($slug)) {
            $stories = $this->Stories->find('all', [
                'order' => ['Stories.id' => 'Desc'],
                'contain' => ['Media'],
            ]);

            $this->set(compact('stories'));
        } else {

            $story = $this->Stories->find('all', [
                'conditions' => ['Stories.slug' => $slug],
                'contain' => ['Media'],
            ])->first();

            $this->set(compact('story'));

            $this->render('blog_single');
        }
    }

    public function trackOrder()
    {
        if ($this->request->is('post')) {
            $http = new Client();
            $postData = $this->request->getData();
            $order_no = $postData['order_no'];

            $response = $http->post("http://oauth.smartship.in/loginToken.php", [
                "username" => "raghav@hpsingh.com",
                "password" => "9ff347472ee1489b88d65c18c4a9d66c",
                "client_id" => "UP2K14LKYA4STYV8XDUL78AFOAJXJ1Q4FIF6DS",
                "client_secret" => "!ZCLC8%AQ)15&Y5C*5QY)D)@LI",
                "grant_type" => "password"
            ], ['headers' => ['Content-Type: application/json']]);

            if ($response->isOk()) {
                $access_token = $response->json['access_token'];
                $response = $http->get("http://api.smartship.in/v1/Trackorder?order_reference_ids=$order_no", [], [
                    'headers' => ["Authorization" => "Bearer " . $access_token]
                ]);

                if ($response->isOk()) {
                    $resultData = $response->json;
                    /* echo "<pre>", print_r($resultData);
                    exit; */
                    if (isset($resultData['data']['scans'])) {
                        foreach ($resultData['data']['scans'] as $key => $val) {
                            $resultData = $val;
                        }
                        $this->set(compact('resultData'));
                    } else {
                        $this->Flash->error('Tracking info not found!');
                    }
                } else {
                    $this->Flash->error('Something went wrong! please try again or contact us');
                }
            } else {
                $this->Flash->error('Something went wrong! please try again or contact us');
            }
        }

        $this->render('track_order');
    }
}
