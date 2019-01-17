$(document).ready(function(){
    $(document).on('click','.control nav a', function(){
        history.pushState(null,null,event.target.href);
        $('article').load(event.target.herf+'article>.content');
        event.preventDefault();
    })
    $(window).on('popstate',function(event){
        $('article').load(location.herf+'article>.content');
    })
});
