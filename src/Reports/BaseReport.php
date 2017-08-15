<?php

namespace KilroyWeb\WPTools\Reports;

abstract class BaseReport {

    protected $headers = [];
    protected $pageCurrent = 1;
    protected $resultsPerPage = 20;
    protected $resultsTotal = 0;
    private $pagesTotal = 1;
    protected $results = [];

    public function init(){
        $results = $this->getResults();
        $this->results = $results;
        $this->resultsTotal = count($results);
        $this->pagesTotal = $this->getTotalPages();
        if(!empty($_GET['paged'])){
            $this->pageCurrent = intval($_GET['paged']);
        }
    }

    public function getTableHTML(){
        $output = [];
        $output[] = '<table class="widefat fixed" cellspacing="0">';
        $output[] = $this->getTableHTMLHead();
        $output[] = $this->getTableHTMLBody();
        $output[] = '</table>';
        $output = implode("\n",$output);
        return $output;
    }

    public function getTableHTMLHead(){
        $output = [];
        $output[] = '<thead>';
        $output[] = '<tr>';
        foreach($this->headers as $header){
            $output[] = '<th>'.$header.'</th>';
        }
        $output[] = '</tr>';
        $output[] = '</thead>';
        $output = implode("\n",$output);
        return $output;
    }

    public function getTableHTMLBody(){
        $results = $this->pagedResults();
        $output = [];
        $output[] = '<tbody>';
        foreach($results as $resultRow){
            $output[] = '<tr>';
            foreach($resultRow as $resultColumn){
                $output[] = '<td>'.$resultColumn.'</td>';
            }
            $output[] = '</tr>';
        }
        $output[] = '</tbody>';
        $output = implode("\n",$output);
        return $output;
    }

    public function getPagerHTML(){
        $output = [];
        $output[] = '<div class="tablenav top">';
        $output[] = '<div class="tablenav-pages">';
        $output[] = '<span class="displaying-num">'.$this->resultsTotal.' items</span>';
        $output[] = '<a class="first-page" href="'.$this->pageFirstURL().'"><span>«</span></a>';
        $output[] = '<a class="prev-page" href="'.$this->pagePreviousURL().'"><span>‹</span></a>';
        $output[] = '<span class="current-page">'.$this->pageCurrent.'</span> of <span class="total-pages">'.$this->pagesTotal.'</span></span></span>';
        $output[] = '<a class="next-page" href="'.$this->pageNextURL().'"><span>›</span></a>';
        $output[] = '<a class="last-page" href="'.$this->pageLastURL().'"><span>»</span></a>';
        $output[] = '</div>';
        $output[] = '</div>';
        $output[] = '<br/>';
        $output = implode("\n",$output);
        return $output;
    }

    private function pageFirstURL(){
        $parameters = [
            'paged' => 1,
        ];
        return $this->updateCurrentURL($parameters);
    }

    private function pagePreviousURL(){
        $newPage = $this->pageCurrent - 1;
        if($newPage < 1){
            $newPage = 1;
        }
        $parameters = [
            'paged' => $newPage,
        ];
        return $this->updateCurrentURL($parameters);
    }

    private function pageNextURL(){
        $newPage = $this->pageCurrent + 1;
        if($newPage > $this->pagesTotal){
            $newPage = $this->pagesTotal;
        }
        $parameters = [
            'paged' => $newPage,
        ];
        return $this->updateCurrentURL($parameters);
    }

    private function pageLastURL(){
        $parameters = [
            'paged' => $this->pagesTotal,
        ];
        return $this->updateCurrentURL($parameters);
    }

    private function updateCurrentURL($parameters){
        $domain = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['SCRIPT_NAME'];
        $queryString = $_SERVER['QUERY_STRING'];
        $queryString = $this->updateQueryStringParameters($queryString, $parameters);
        $url = "//" . $domain . $path . "?" . $queryString;
        return $url;
    }

    private function updateQueryStringParameters($queryString, $newParameters){
        parse_str($queryString, $queryParameters);
        $queryParameters = array_merge($queryParameters,$newParameters);
        $queryString = http_build_query($queryParameters);
        return $queryString;
    }

    private function pagedResults(){
        $results = [];
        $allResults = $this->results;
        $resultCountStart = $this->getPageResultCountStart();
        $resultCountEnd = $this->getPageResultCountEnd();
        $currentCount = 0;
        foreach($allResults as $allResult){
            if($currentCount >= $resultCountStart && $currentCount <= $resultCountEnd){
                $results[] = $allResult;
            }
            $currentCount++;
        }
        return $results;
    }

    private function getPageResultCountStart(){
        $count = ($this->pageCurrent*$this->resultsPerPage)-$this->resultsPerPage;
        return $count;
    }

    private function getPageResultCountEnd(){
        $count = ($this->pageCurrent*$this->resultsPerPage)-1;
        return $count;
    }

    private function getTotalPages(){
        $pages = $this->resultsTotal / $this->resultsPerPage;
        $pages = ceil($pages);
        return $pages;
    }

    public function getResults(){
        return [];
    }

}