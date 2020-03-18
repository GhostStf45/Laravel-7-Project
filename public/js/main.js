'use strict'
$(document).ready(function () {
    var url = "http://proyecto-laravel.com.devel";
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    //boton de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.png');
            
            $.ajax({
               url: url+'/like/'+$(this).data('id'),
               type: 'GET',
               success: function(res){
                   if(res.like){
                       console.log("Has dado like a la publicacion");
                   }else{
                       console.log("Error al dar like");
                   }
                   
               }
            });
            
            dislike();
        });
    }
    like();
    //boton de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/hearts-gray.png');
            
            $.ajax({
               url: url+'/dislike/'+$(this).data('id'),
               type: 'GET',
               success: function(res){
                   if(res.like){
                       console.log("Has dado dislike a la publicacion");
                   }else{
                       console.log("Error al dar dislike");
                   }
                   
               }
            });
            
            
            like();
        });
    }
    dislike();
    
    //----------------------Efecto scroll para la barra de navegacion---------------------
    
    $(window).scroll(function(){
      var header = $(document).scrollTop();
      var headerHeight = $('.navbar').outerHeight();
      
      if(header > headerHeight){
          $(".navbar").addClass("fixed-top");
      }else{
          $(".navbar").removeClass("fixed-top");
      }
      
    });
    //Buscador
    $('#form-search').submit(function(e){
       $(this).attr('action', url+'/gente/'+$('#form-search #search').val());
    });
});



