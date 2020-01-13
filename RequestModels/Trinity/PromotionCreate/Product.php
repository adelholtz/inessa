<?php

namespace Inessa\RequestModels\Trinity\PromotionCreate;
use Inessa\RequestModels\Base\BasicNode;

class Product {

	/**
	 * @getMethod getArticle
	 * @setMethod setArticle
	 * @type string
	 * @var BasicNode
	 */
	protected $article;

	/**
	 * @getMethod getBusinesscase
	 * @setMethod setBusinesscase
	 * @type string
	 * @var BasicNode
	 */
	protected $businesscase;


	function getArticle() {
		return $this->article;
	}

	function getBusinesscase() {
		return $this->businesscase;
	}

	function setArticle($article = "") {
        $this->article = new BasicNode($article);
		return $this->article;
	}

	function setBusinesscase($businesscase = "") {
        $this->businesscase = new BasicNode($businesscase);
		return $this->businesscase;
	}


}
