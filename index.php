<html>
  <head>
  	<meta charset="utf-8">
  	<meta lang="ru">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link id="style" rel="stylesheet" href="style_standart.css">
  	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  	<title>Поиск по википедии</title>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script>
	  var timerStart = Date.now();</script>
  </head>
  <body>

    
   <div class="container">
   <div class="row">
   <div class="col-md-12">
    <div class="search_form">
    <h2>Поиск в википедии</h2>
    <form method="post" class="form">
     	<input type="text" name="request" class="input" placeholder="Введите запрос"/>
      <i class="fa fa-search" aria-hidden="true"></i>
      
      <input type="submit" id="sub" value="Найти">
      
    </form>
    </div>
    </div> <!--end col-md-12-->
 </div> <!--end row-->
 
 
  <?php
  
    if (isset($_POST['request'])) {
      require_once 'Zend/Loader.php'; //подлкючение классов Zend 
      Zend_Loader::loadClass('Zend_Rest_Client');
 
   
      //новый объект класса Zend_Rest_client
	  $wikipedia = new Zend_Rest_Client('http://ru.wikipedia.org/w/api.php');
 
      // задание параметров класса для объекта wikipedia с mediawiki
      $wikipedia->action('query');
      $wikipedia->list('search');
	  $wikipedia->srlimit('20');
      $wikipedia->srwhat('text');
      $wikipedia->format('xml');
      $wikipedia->srsearch($_POST['request']);
 
      // выполнение запроса
      $result = $wikipedia->get();
    ?>
    
    
    
   <div class="row">
    
   <div class="col-md-9">
    <div class="result">
    <h2>Результаты поиска по запросу: '<?php echo $_POST['request']; ?>'</h2>
    <ol>
    <?php 
		foreach ($result->query->search->p as $r): ?> 
      <li><a href="http://ru.wikipedia.org/wiki/<?php echo $r['title']; ?>">
      <?php echo $r['title']; ?></a> <br/>
      <small><?php echo $r['snippet']."..."; ?></small></li>
    <?php endforeach; ?>
    </ol>
    <?php
	} 
    ?>
    </div> <!--end result-->
    </div> <!--end col-md-9-->
    
   <div class="col-md-3">
    	<div class="place_for_comments">
    		<h4>Предыдущие запросы: </h4>
    		<p id="prev_search"></p>
    		<h4>Время загрузки страницы: </h4>
    		<p id="load"></p>
    		<h4>Переключить интерфейс: </h4>
    		<p class="change_interface"><a href="#" id="standart">Стандартный</a></p>
    		<p class="change_interface"><a href="#" id="dark">Инверсия</a></p>
    		<h4 id="reset">Очистить историю запросов</h4>
    	</div>
    </div>
   
 </div> <!--end row-->
 </div> <!--end container-->
 <script src="index.js"></script>
  </body>
</html>
