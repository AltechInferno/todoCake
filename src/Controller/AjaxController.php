<?php

namespace App\Controller;

use App\Controller\AppController;

class AjaxController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        $this->loadModel("Events");
    }

    public function ajaxAddEvent(){

        if ($this->request->is('ajax')) {
            
            $event = $this->Events->newEmptyEntity();

            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {

                $this->Flash->success(__('Event has been created'));

                echo json_encode(array(
                    "status" => 1,
                    "message" => "Event has been created"
                )); 

                exit;
            }

            $this->Flash->error(__('Failed to save student data'));

            echo json_encode(array(
                "status" => 0,
                "message" => "Failed to create"
            )); 

            exit;
        }
    }
}