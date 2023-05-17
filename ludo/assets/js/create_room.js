$(document).ready(function(){
    // $("button#create_room_btn").click(function(){
    //     if($("input#room_name_field").val() != ''){
    //         $("div.create_room").hide();
    //         $("span#share_url").html("Share url &nbsp;&nbsp;&nbsp;<a href='"+window.location.href+"?room_name="+$("input#room_name_field").val()+"'>"+window.location.href+"?room_name="+$("input#room_name_field").val()+"</a>");
    //         // window.history.pushState('page2', 'Title', '?room_name='+$("input#room_name_field").val());
    //         $("div.share_url").show();
    //     }
    // });

    $("#create_room_btn").click(function(e){
        e.preventDefault();
        var data = $(this).parent().parent().serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "database/create_room.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        location.reload();			
					}
					else if(dataResult.statusCode==201){
					   alert(dataResult);
					}
			}
		});
    });


    $("#join_room_btn").click(function(e){
        e.preventDefault();
        var data = $(this).parent().parent().serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "database/join_room.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        var messageJSON = {
                            user: sharecode,
                            action: 'join_game',
                            data: {}
                        };
                        websocket.send(JSON.stringify(messageJSON));
					}
					else if(dataResult.statusCode==201){
					   alert(dataResult);
					}
			}
		});
    });

    $("button.players").css({'filter': 'brightness(0.5)'});
    $("button.players").hover(function(){
        $("button.players").css({'filter': 'brightness(0.5)'});
        $(this).css({'filter': 'unset'});
    });

    $("button.players").click(function(e){
        e.preventDefault();
        $("button.player").css({'filter': 'brightness(0.5)'});
        $(this).css({'filter': 'unset'});
        $("#choose_color").val($(this).attr('data-value'));
    });

});