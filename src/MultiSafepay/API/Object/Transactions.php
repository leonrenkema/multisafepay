<?php
class MultiSafepay_API_Object_Transactions extends MultiSafepay_API_Object_Core{
    
    public $success;
    public $data;
    
    public function patch($body, $endpoint = '') {
        $result = parent::patch(json_encode($body), $endpoint);
        $this->success = $result->success;
        $this->data = $result->data;
        return $this->data;
    }
    
    public function get($endpoint = 'transactions', $id, $body=array(), $query_string = false) {
        $result = parent::get($endpoint, $id, $body, $query_string);
        $this->success = $result->success;
        $this->data = $result->data;
        return $this->data;
    }
    
}