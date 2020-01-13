<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate; 

class Product {
 
	/**
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\Article
	 * 
	 * @getMethod getArticle
	 * @setMethod setArticle 
	 * @var Article
	 */
	protected $article;

	/**
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\BusinessCase
	 * 
	 * @getMethod getBusinesscase
	 * @setMethod setBusinesscase 
	 * @var BusinessCase
	 */
	protected $businesscase;

	/**
	 * @setMethod setPrice_required
	 * @attribute price_required
	 * @var string
	 */
	protected $price_required;

	function getPrice_required() {
		return $this->price_required;
	}

	function setPrice_required($price_required) {
		$this->price_required = $price_required;
	}

	function getArticle() {
		return $this->article;
	}

	function getBusinesscase() {
		return $this->businesscase;
	}

	function setArticle($article) {
		$this->article = $article;
	}

	function setBusinesscase($businesscase) {
		$this->businesscase = $businesscase;
	}

}
