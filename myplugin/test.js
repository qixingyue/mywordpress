//保持脚本之间的独立性，不必要要求外界在引用自己的�要包含其他的js文件
if(!window.$){
	 var head = document.getElementsByTagName('head')[0];
	 var jquery = document.createElement("script");
	 jquery.type = "text/javascript";
	 jquery.src = "http://tmsdk.sinaapp.com/javascript/jquery.1.6.2.js";
	 if (document.all) { //如果是IE
           jquery.onreadystatechange = function () {
               if (jquery.readyState == 'loaded' || jquery.readyState == 'complete') {
                	testJquery();
               }
          }
     }  else {	//火狐浏览器
            jquery.onload = function () {
                    testJquery();
             }
      }
	 head.appendChild(jquery);
}else{
	testJquery();
}

function testJquery(){
	$(function(){
		$('#myPluginComment').mouseover(function(){
			$(this).css('background-color','#fff');
		}).mouseout(function(){
			$(this).css('background-color','#eee');
		});
	});
}


