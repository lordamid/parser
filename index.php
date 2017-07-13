<?php	

	header('Content-Type: text/html; charset=utf-8');

	require_once 'curl-master/curl.php';
	require_once 'phpquery-master/phpQuery/phpQuery.php';


	$site = 'https://maslobaza.com/';								

	$curl = new Curl();												
	$response = $curl->get($site);									
	$pageBody = phpQuery::newDocument($response->body);

	$findSection = $pageBody->find('#cat_accordion');
	$sectionHtml = $findSection->html();

	// Если закоментировать все начиная с 20 строки до вардампа то русскими буквами все выводится... 	А с ней фигня. :(							

	$sectionBody = phpQuery::newDocument($sectionHtml);

	$links = $sectionBody->find('a');										

	foreach ($links as $link) {
		
		$pqLink = pq($link);

		$href[] = $pqLink->attr('href');
		$text[] = $pqLink->text();
	}

	$curl = new Curl();
	$response = $curl->get($href[3] . '?limit=5');

	$pageBody = phpQuery::newDocument($response->body);

	$pageBody->find('.image')->remove();
	$pageBody->find('.extra')->remove();
	$pageBody->find('.promotion')->remove();
	$pageBody->find('.description')->remove();
	$pageBody->find('.price')->remove();
	$pageBody->find('.rating')->remove();
	$pageBody->find('.cart')->remove();
	$pageBody->find('.wishlist')->remove();
	$pageBody->find('.compare')->remove();

	$findSection = $pageBody->find('.product-list');


	$sectionHtml = $findSection->html();	

	$sectionBody = phpQuery::newDocument($sectionHtml);

	$productLinks = $sectionBody->find('a');										

	foreach ($productLinks as $productLink) {
		
		$pqLink = pq($productLink);

		$arrayLink[] = $pqLink->attr('href');
	}

	$curl = new Curl();
	$response = $curl->get($arrayLink[0]);

	$pageBody = phpQuery::newDocument($response->body);

	$findSection = $pageBody->find('.product-info');
	$findSection2 = $pageBody->find('.product-description');
	$sectionHtml = $findSection->html() . '<br>' . $findSection2->html(); */

	var_dump($sectionHtml);
?>