$(document).ready(function(){
	
  $(".fa-search").click(function(){
    $(".form, .input, input[type='submit']").toggleClass("active");
    $("input[type='text']").focus();
  }); //форма поиска
	
	var result = document.getElementsByClassName('result')[0]; //если страницы с результатом нет, то устанавливаем параметры отображения
	if (!result){
		$('.col-md-12').css({'top':'200px', 'transition':'all 0.5s'});
		$('.col-md-3').css({'display':'none'});
		var word = ['крещение Руси','история ЭВМ','карпаччо','Джимми Уэйлс','Гранада','Конституция РФ','список номинаций на оскар 2018','Екатеринбург'];
		var randWordIndex = Math.floor(Math.random()*word.length);
		var randWord = word[randWordIndex];
		
		$('.col-md-12').append('<p><small>Например: <a href="#">'+randWord+'</a></small></p>');
		$('.col-md-12').css({'border':'none'});
		
		$('.col-md-12 p a').on('click', function(){
			var aText = ($(this).text());
			$('.input').val(aText);
			$('.input').focus();
			$('.form').submit();
			window.localStorage.setItem(arr_len+1, aText); //запись в  localStorage значения из ссылки "например"
		}); //конец click для поиска добавления ссылки на предыдущий запрос
	}; //конец блока if для начальной страницы до вывода результатов поиска
	
	var i = 0,
		arr = {},
		outKey;
	for (; outKey = window.localStorage.key(i); i++){
		arr[outKey] = window.localStorage.getItem(outKey); 	
	} // выводим весь массив из localstorage

	var arr_len = Object.keys(arr).length; // длина ассоциативного массива
	/*if (arr_len == undefined){arr_len=0};*/

	// если в хранилище больше 10 запросов, удаляем первый
	if (arr_len>=10){
		var first = Object.keys(arr).shift();
		localStorage.removeItem(first);
	}
	var arr_values = Object.values(arr); //выводим в массив с числовыми индексами значения из ассоциативного массива
	for (n = 0; n<arr_values.length; n++){
		$('#prev_search').append('<a href="#">'+arr_values[n]+'  </a>') 
	}// конец цикла для добавления ссылки на предыдущие запросы
	
	$("#sub").click(function(){
		var val = document.getElementsByClassName('input')[0].value;
		window.localStorage.setItem(arr_len+1, val); //записываем в localstorage значение поиска
	});//конец click для кнопки поиска
	
	$('#prev_search>a').on('click', function(){
		aText = ($(this).text());
		$('.input').val(aText);
		$('.input').focus();
		$('.form').submit();
	}); // конец click для ссылок на предыдущие запросы
	var timeLoad = Date.now()-timerStart; //timerStart объявлен в теге head для получения времени в самом начале загрузки страницы
	
	$('#load').append(timeLoad+' мс');
	
	$('.change_interface>a').on('click', function(){
		var style_name = $(this).attr('id');
		$('head>link[rel=stylesheet]:eq(0)').attr('href', 'style_'+style_name);
	}); //конец click для изменения атрибута link, отвечающего за подключение style.css
	
	$('#reset').on('click', function(){
		localStorage.clear();
		$('#prev_search>a').remove();
	}); //конец click для строки очистки localStorage
	
}); // конец ready
