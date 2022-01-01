<?php 

namespace App\Controller;

class TodoController extends AppController
{
    // public function initialize(): void
    // {
    //     parent::initialize(); 
    //     $this->loadModel("events");

    //     $this->viewBuilder()->setLayout('todo'); 

    // }

    

    public function home(){
        $this->viewBuilder()->setLayout('todo'); 
        
        $this->loadModel('events');
        
        $events = $this->events->find('all'); 

        $this->set('events',$events); 

         //pending query
         $qevents = $this->events->find('all'); 
        $query = $qevents->find('all')->where(['status' => 'pending']); 
        $query->select(['count' => $query->func()->count('*')]); 
        $pending = $query->toArray(); 
        $pendingCount = $pending[0]->count; 
        $this->set('pending',$pendingCount);

        //Completed query 
        $cEvents = $this->events->find('all');
        $cQuery = $cEvents->find('all')->where(['status' => 'completed']); 
        $cQuery->select(['count' => $cQuery->func()->count('*')]); 
        $completed = $cQuery->toArray(); 
        $completedCount = $completed[0]->count; 
        $this->set('completed', $completedCount);

        //failed query 
        $fEvents = $this->events->find('all');
        $fQuery = $fEvents->find('all')->where(['status' => 'failed']); 
        $fQuery->select(['count' => $fQuery->func()->count('*')]); 
        $failed = $fQuery->toArray(); 
        $failedCount = $failed[0]->count; 
        $this->set('failed', $failedCount);
    }

    public function insert(){

        if ($this->request->is('ajax')) {
            
            $eventsDt = $this->Event->newEmptyEntity();

            $eventsDt = $this->Event->patchEntity($eventsDt, $this->request->getData());
            if ($this->Event->save($eventsDt)) {

                $this->Flash->success(__('Event has been created'));

                echo json_encode(array(
                    "status" => 1,
                    "message" => "Event has been created"
                )); 

                exit;
            }

            $this->Flash->error(__('Failed to save event data'));

            echo json_encode(array(
                "status" => 0,
                "message" => "Failed to create"
            )); 

            exit;
        }
      
    }
    
}


?>