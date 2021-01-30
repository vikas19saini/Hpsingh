<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Log\Log;
use Thumber\Utility\ThumbCreator;

class OrdersShell extends Shell {

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

    public function updateStatus() {

        $this->loadModel('Orders');

        $orders = $this->Orders->find('all', [
            'conditions' => ['Orders.status' => 'pending-payment', 'TIMESTAMPDIFF(MINUTE, created, NOW()) >=' => 30],
        ]);

        foreach ($orders as $order) {
            if ($this->Orders->updateStatus($order->id, 'failed')) {
                Log::notice('Order status for order number ' . $order->id . ' has been updated', 'order');
            } else {
                Log::warning('Order status for order number ' . $order->id . ' couldn\'t be successfully updated', 'order');
            }
        }
    }

    public function remove(){
        $this->loadModel("Media");

        $medias = $this->Media->find('all');

        foreach ($medias as $media) {
            if($media->type !== "image/svg+xml"){
                $fileName = @explode("/", $media->url)[1];
                if(file_exists(WWW_ROOT . "media" . DS  . "Th_" . $fileName)){
                    unlink(WWW_ROOT . "media" . DS  . "Th_" . $fileName);
                }
            }
        }    
    }

}
