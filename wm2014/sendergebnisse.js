/* ausführen, wenn html-seite geladen wurde */
jQuery(document).ready(function($) {

    $(".saveButton").click(function() {
		var buttonID = $(this).attr('id');
		var ID = buttonID.substr(0, buttonID.indexOf('_'));
		var ergebnis_h = $("#"+ID+"_ergebnis_h").val();
		var ergebnis_g = $("#"+ID+"_ergebnis_g").val();
		var gruppe_h = $("#"+ID+"_gruppe_h").val();
		var gruppe_g = $("#"+ID+"_gruppe_g").val();
		
			if(!isNaN(ergebnis_h) && !isNaN(ergebnis_g)){
				$("#"+ID+"_div").hide().load("wm2014/load.html").fadeIn(500);
				$.ajax({
				type: "POST",
				url: "wm2014/save_ergebnisse.php",
				data: "ergebnis_h=" + ergebnis_h + "&ergebnis_g=" + ergebnis_g + "&spielid=" + ID + "&gruppe_h=" + gruppe_h + "&gruppe_g=" + gruppe_g,
				success: function(msg)
				{
					$("#"+ID+"_div").hide().text(msg).fadeIn(2000);
					$("#"+ID+"_ergebnis_h").val('');
					$("#"+ID+"_ergebnis_g").val('');                
				}
			});
			return false;
			}
			else{
				$("#"+ID+"_div").hide().text("Bitte nur Zahlen eingeben!").fadeIn(2000);
			}
			return false;
		});
		$(".saveBonusButton").click(function() {
			var buttonID = $(this).attr('id');
			var ID = buttonID.substr(0, buttonID.indexOf('_'));
			var bonusergebnis = $("#"+ID+"_bonusergebnis").val();
			var bonusergebnis_text = $("#"+ID+"_bonusergebnis option:selected").text();
			
			$("#"+ID+"_div").hide().load("wm2014/load.html").fadeIn(500);
			$.ajax({
			type: "POST",
			url: "wm2014/save_bonusergebnisse.php",
			data: "bonusergebnis=" + bonusergebnis + "&bonusergebnis_text=" + bonusergebnis_text + "&spielid=" + ID,
			success: function(msg)
			{
				$("#"+ID+"_div").hide().text(msg).fadeIn(2000);        
			}
			});
			return false;
		});
		$(".saveEndrundeButtonH").click(function() {
			var buttonID = $(this).attr('id');
			var ID = buttonID.substr(0, buttonID.indexOf('_'));
			var land = $("#"+ID+"_landH").val();
			var land_text = $("#"+ID+"_landH option:selected").text();
			var gruppe = "H";
			
			$("#"+ID+"_EndrundeDivH").hide().load("wm2014/load.html").fadeIn(500);
			$.ajax({
			type: "POST",
			url: "wm2014/save_endrunde.php",
			data: "land=" + land + "&land_text=" + land_text + "&gruppe=" + gruppe + "&spielid=" + ID,
			success: function(msg)
			{
				$("#"+ID+"_EndrundeDivH").hide().text(msg).fadeIn(2000);        
			}
			});
			return false;
		});
		$(".saveEndrundeButtonG").click(function() {
			var buttonID = $(this).attr('id');
			var ID = buttonID.substr(0, buttonID.indexOf('_'));
			var land = $("#"+ID+"_landG").val();
			var land_text = $("#"+ID+"_landG option:selected").text();
			var gruppe = "G";
			
			$("#"+ID+"_EndrundeDivG").hide().load("wm2014/load.html").fadeIn(500);
			$.ajax({
			type: "POST",
			url: "wm2014/save_endrunde.php",
			data: "land=" + land + "&land_text=" + land_text + "&gruppe=" + gruppe + "&spielid=" + ID,
			success: function(msg)
			{
				$("#"+ID+"_EndrundeDivG").hide().text(msg).fadeIn(2000);        
			}
			});
			return false;
		});
		$(".switchery").click(function() {
			var buttonID = $(this).attr('id');
			var ID = buttonID.substr(0, buttonID.indexOf('_'));
			var beitrag;
			var beitrag_text;
			
			if ($("#"+ID+"_beitragcheckbox").is(':checked')){
				beitrag = 1;
				beitrag_text = "Ja";
			}
			else{
				beitrag = 0;
				beitrag_text = "Nein";
			}
			
			$("#"+ID+"_BeitragDiv").hide().load("wm2014/load.html").fadeIn(500);
			$.ajax({
			type: "POST",
			url: "wm2014/save_beitrag.php",
			data: "beitrag=" + beitrag + "&beitrag_text=" + beitrag_text + "&userid=" + ID,
			success: function(msg)
			{
				$("#"+ID+"_BeitragDiv").hide().text(msg).fadeIn(2000);        
			}
			});
			return false;
		});
		$(".delButton").click(function() {
			var buttonID = $(this).attr('id');
			var ID = buttonID.substr(0, buttonID.indexOf('_'));
			$("#"+ID+"_div").hide().load("wm2014/load.html").fadeIn(500);
			$.ajax({
				type: "POST",
				url: "wm2014/del_ergebnisse.php",
				data: "spielid=" + ID,
				success: function(msg)
				{
					$("#"+ID+"_div").hide().text(msg).fadeIn(2000);
				}
			});
			return false;
		});
});