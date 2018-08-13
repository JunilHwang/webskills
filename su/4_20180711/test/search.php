<?php
	include_once("config.php");

	$relatedKeywordList = RelatedSearch::getRelatedList("가");

	print_pre($relatedKeywordList);