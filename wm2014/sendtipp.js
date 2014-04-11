/* ausführen, wenn html-seite geladen wurde */
jQuery(document).ready(function($) {

    /* sendung formular abfangen */
    $(".saveButton").click(function() {
		var buttonID = $(this).attr('id');
		var ID = buttonID.substr(0, buttonID.indexOf('_'));

			var spielzeit = $("#"+ID+"_spielzeit").val();
			var tipp_h = $("#"+ID+"_tipp_h").val();
			var tipp_g = $("#"+ID+"_tipp_g").val();
			var tipp_sonder = $("#"+ID+"_tipp_sonder").val();
			var tipp_sonder_text = $("#"+ID+"_tipp_sonder option:selected").text();
		
			if (ID < 70)
			{
				if(!isNaN(tipp_h) && !isNaN(tipp_g)){
					$("#"+ID+"_div").hide().load("wm2014/load.html").fadeIn(500);
					$.ajax({
					type: "POST",
					url: "wm2014/save_tipps.php",
					data: "tipp_h=" + tipp_h + "&tipp_g=" + tipp_g + "&spielid=" + ID + "&spielzeit=" + spielzeit,
					success: function(msg)
					{
						$("#"+ID+"_div").hide().text(msg).fadeIn(2000);
						$("#"+ID+"_tipp_h").val('');
						$("#"+ID+"_tipp_g").val('');                
						//alert(msg);
					}
				});
				return false;
				}
				else{
					$("#"+ID+"_div").hide().text("Bitte nur Zahlen eingeben!").fadeIn(2000);
				}
				return false;
			}
			else
			{
				if(!isNaN(tipp_sonder)){
					$("#"+ID+"_div").hide().load("wm2014/load.html").fadeIn(500);
					$.ajax({
					type: "POST",
					url: "wm2014/save_tipps.php",
					data: "tipp_sonder=" + tipp_sonder + "&spielid=" + ID + "&spielzeit=" + spielzeit + "&tipp_sonder_text=" + tipp_sonder_text,
					success: function(msg)
					{
						$("#"+ID+"_div").hide().text(msg).fadeIn(2000);
					}
				});
				return false;
				}
				else{
					$("#"+ID+"_div").hide().text("Bitte nur Zahlen eingeben!").fadeIn(2000);
				}
				return false;
			}
		});
		$(".saveAllButton").click(function() {
				var list = [];
				for(var i = 1; i < 65; i++) {
					var tipp_h = $("#"+i+"_tipp_h").val();
					var tipp_g = $("#"+i+"_tipp_g").val();				
					if(tipp_h != "" && tipp_g  != "")
					{
						list.push(i);
					}
				}
				$.each(list,function(index,Element){
					setTimeout(function(){
						$("#"+Element+"_button").trigger("click");
					}, 300 * index)
					//alert(Element);
				})
		});
		$(".delButton").click(function() {
				var buttonID = $(this).attr('id');
				var ID = buttonID.substr(0, buttonID.indexOf('_'));
				$("#"+ID+"_div").hide().load("wm2014/load.html").fadeIn(500);
				$.ajax({
				type: "POST",
				url: "wm2014/del_tipps.php",
				data: "spielid=" + ID,
				success: function(msg)
				{
					$("#"+ID+"_div").hide().text(msg).fadeIn(2000);
				}
			});
			return false;
		});
});