<?php

namespace App\Shell;

use Cake\Console\Shell;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Cake\Http\Client;

/**
 * FacebookShop shell command.
 */
class FacebookShopShell extends Shell {

    private $feedDirectory = WWW_ROOT . 'facebook-feeds';


    public function getOptionParser() {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        $this->out($this->OptionParser->help());
    }

    public function upload() {

        $this->generateFeed();
    }

    public function generateFeed() {
        $this->loadModel('Products');

        $csvHeaders = ['id', 'title', 'description', 'availability', 'condition', 'price', 'link', 'image_link', 'brand', 'additional_image_link', 'sale_price', 'google_product_category'];

        $products = $this->Products->find('all', [
                    'conditions' => ['status' => 'published', 'deleted IS' => NULL, 'ragular_price !=' => 0],
                    'contain' => ['Media'],
                ])->limit(10)->toArray();

        $formattedProducts = array_map(function($product) {
            return $this->generateRow($product);
        }, $products);

        if (!is_dir($this->feedDirectory)) {
            mkdir($this->feedDirectory);
        }

        $feedShortName = 'fbfeed-' . strtotime('now') . '.csv';
        $feedName = $this->feedDirectory . DIRECTORY_SEPARATOR . $feedShortName;

        if (create_file($feedName, null, 777)) {
            $feedCsv = WriterFactory::create(Type::CSV);
            $feedCsv->openToFile($feedName);
            $feedCsv->addRow($csvHeaders);
            $feedCsv->addRows($formattedProducts);
            $feedCsv->close();
            
            $this->loadModel('FacebookFeed');
            $facebookFeed = $this->FacebookFeed->newEntity([
                'name' => $feedShortName,
                'status' => 'generated',
            ]);
            
            if(!$this->FacebookFeed->save($facebookFeed)){
                $this->log('Facebook feed generated but couldn\'t be saved in database', LOG_ERR, 'fbfeeds');
            }
        }
    }

    public function generateRow($product) {
        $price = $product->ragular_price . ' INR';
        $link = \Cake\Core\Configure::read('Store.url') . \Cake\Routing\Router::url(['_name' => 'product', $product->slug], true);
        $sale_price = empty($product->sale_price) ? '' : $product->sale_price . ' INR';
        $image_link = !is_object($product->featured_image) ? \Cake\Core\Configure::read('Store.url') . '/img/image_placeholder.png' : \Cake\Core\Configure::read('Store.url') . '/' . $product->featured_image->url;
        $additional_image_link = [];

        if (!empty($product->product_thumbnail)) {
            foreach ($product->product_thumbnail as $thumbnail) {
                if (is_object($thumbnail)) {
                    $thumbnail_link = \Cake\Core\Configure::read('Store.url') . '/' . $thumbnail->url;
                    array_push($additional_image_link, $thumbnail_link);
                }
            }
        }

        $additional_image_link = implode(',', $additional_image_link);

        return [$product->id, substr($product->name, 0, 150), substr($product->long_description, 0, 5000), str_replace('_', ' ', $product->stock), 'new',
            $price, $link, $image_link, 'HP Singh', $additional_image_link, $sale_price, 'Prints'];
    }
    
    public function uploadToCatalog($facebookFeed){
        $client = new Client();
        
        $url = "https://graph.facebook.com/" . env('FB_CATALOG_ID') . "/product_feeds";
        $response = $client->post($url, [
            'access_token' => env('FB_CATALOG_ACCESS_TOKEN'),
        ]);
    }
}
