<?php

require_once __DIR__ . '/libs/Page.php';
require_once __DIR__ . '/models/Article.php';

$GLOBALS['article'] = Article::find($_GET['id']);
Page::get('article', $article['title']);
