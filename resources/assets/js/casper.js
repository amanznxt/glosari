var casper = require('casper').create();
var keyword = casper.cli.get(0);

casper.start('http://prpm.dbp.gov.my/Search.aspx?k=' + keyword, function(){
	//do nothing, at this stage we just open the page
});

casper.then(function(){
	var info = this.evaluate(function(){
		var arrayObjects = new Array();
		jQuery("#ctl00_uxcp_SearchInfoPanel1_lblTesaurus table tbody tr").each(function(index){
			var tableResult = jQuery(this);
			objResult = new Object();
			objResult.word = tableResult.find('td b span').text();
			objResult.type = tableResult.find('td font[color="blue"]').text();

			if (objResult.word != '' && objResult.type != '')
			{
				arrayObjects = objResult;
			}
		});

		return arrayObjects;
	});

	this.echo(JSON.stringify(info, undefined, 4));
});

casper.run();
