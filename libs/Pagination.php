<?php
class Pagination
{

	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 3;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	public  $currentPage			= 1;	// Trang hiện tại

	public function __construct($totalItems, $totalItemsPerPage, $pageRange, $currentPage)
	{
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $totalItemsPerPage;

		if ($pageRange % 2 == 0) $pageRange = $pageRange + 1;

		$this->pageRange			= $pageRange;
		$this->currentPage			= $currentPage;
		$this->totalPage			= ceil($totalItems / $totalItemsPerPage);
	      
// 		echo '<h3>'. __METHOD__ . '</h3>';
// 		echo 'totalItems: '. $this->totalItems.'<br/>';
// 		echo 'totalItemsPerPage: '. $this->totalItemsPerPage .'<br/>';
// 		echo 'pageRange: '. $this->pageRange.'<br/>';
//         echo 'currentPage: '.$this->currentPage;
	}

	public function showPagination($link = '?module=backend&controller=group&action=list')
	{
		// Pagination
		$paginationHTML = '';
		if ($this->totalPage > 1) {
			
			$start  = '<li class="page-item disabled"><a class="page-link">Start</a></li>';
			$prev   =  '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
			
			if ($this->currentPage > 1) {
				$start  = '<li class="page-item"><a class="page-link" href="'.$link.'&page=1">Start</a></li>';
				$prev 	= '<li class="page-item"><a class="page-link" href="'.$link.'&page=' . ($this->currentPage - 1) . '">Previous</li>';
			}

			$next 	= '<li class="page-item disabled"><a class="page-link">Next</a></li>';
			$end 	= '<li class="page-item disabled"><a class="page-link">End</a></li>';
			
			if ($this->currentPage < $this->totalPage) {
				$next 	= '<li class="page-item"><a class="page-link" href="'.$link.'&page=' . ($this->currentPage + 1) . '">Next</a></li>';
				$end 	= '<li class="page-item"><a class="page-link" href="'.$link.'&page=' . $this->totalPage . '">End</a></li>';
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '';
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
				} else {
					$listPages .= '<li class="page-item"><a class="page-link" href="'.$link.'&page=' . $i . '">' . $i . '</a>';
				}
			}

			$paginationHTML = '<ul class="pagination">' . $start . $prev . $listPages . $next . $end . '</ul>';
		}
		return $paginationHTML;
	}
}
