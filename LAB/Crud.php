<?php
interface Crud
{
    public function save();
    public function readAll();
    public function readUnique();
    public function search();
    public function update();
    public function removeOne();
    public function removeAll();

    //For lab 2
    public function validateForm();
    public function createFormErrorSessions();

    //for lab 4
    public function checkOrderStatus();
    public function fetchAllOrders();
    public function checkApiKey();
    public function checkkContentType();
}