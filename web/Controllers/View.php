<?php
class Table
{
    private $pageIndex = 1;
    private $numOfItems;
    private $count;
    private $data;
    private $pages;
    public function __construct($data, $numOfItems, $pageIndex)
    {
        $this->data = $data;
        $this->numOfItems = $numOfItems;
        $this->pageIndex = $pageIndex;
        $this->count = sizeof($data);
        $this->pages = intval(ceil($this->count/$this->numOfItems));
    }
    public function GetPageIndex(){
        return $this->pageIndex;
    }
}
?>