var root_path = 'https://dss4hsr.net/'
var api = 'https://fxplor.com/wisnior_webstat/controller/set_access.php'
var webstat = {
  init(ele, type){

    var sPath = window.location.href;
    $page = sPath.split(root_path)
    console.log($page);

    var param = {
      url: root_path,
      pagename: ''
    }

    if($page.length > 1){
      param = {
        url: root_path,
        pagename: $page[1]
      }
    }

    var jxr = $.post('https://fxplor.com/wisnior_webstat/controller/set_access.php', param, function(){})
               .always(function(resp){ console.log(resp); })

    webstat.init_display(ele, type)

  },
  init_display(ele, type){
    var param = {
      url: root_path,
      type: 'table'
    }
    var jxr = $.post('https://fxplor.com/wisnior_webstat/controller/get_access_2.php', param, function(){})
               .always(function(resp){
                 if(type == 'class'){
                   $('.' + ele).html(resp)
                 }else{
                   $('#' + ele).html(resp)
                 }
               })
  }
}

webstat.init()