<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	// Game scripts
	$cs->registerScriptFile($baseUrl.'/js/fun/4x/main.js');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/fun/4x/main.css');
?>

<div id="game_header">
	<h2>Welcome to your world.</h2>
	
	<div id="flavor_text">It's a pretty nice place.</div>
</div><!-- END <div id="4x_header"> -->

<div id="game_window">
	<div id="stats_pane">
		<h3>Turn Stats</h3>
		<ul>
			<li class="4x_stat stat_industry_listing">
				<strong>Industry:</strong> <span id="4x_stat_industry">loading...</span>
			</li>
			
			<li class="4x_stat stat_economy_listing">
				<strong>Economy:</strong> <span id="4x_stat_economy">loading...</span>
			</li>

			<li class="4x_stat stat_science_listing">
				<strong>Science:</strong> <span id="4x_stat_science">loading...</span>
			</li>

			<li class="4x_stat stat_social_listing">
				<strong>Growth:</strong> <span id="4x_stat_growth">loading...</span>
			</li>
		</ul>
		
		<hr />
		
		<h3>Game Stats</h3>
		<ul>
			<li class="4x_stat stat_population_listing">
				<strong>Population:</strong> <span id="4x_stat_population">loading...</span>
			</li>
			
			<li class="4x_stat stat_money_listing">
				<strong>Money:</strong> <span id="4x_stat_money">loading...</span>
			</li>

			<li class="4x_stat stat_social_listing">
				<strong>Social Score:</strong> <span id="4x_stat_social">loading...</span>
			</li>
		</ul>
		
	</div> <!-- END <div id="stats_pane"> -->
		
	
	<div id="upgrade_pane">
		<h3>Build Infrastructure</h3>
		<ul id="infrastructure_list">
			<li id="infrastructure_factories">
				<strong id="owned_factories"></strong> factories | <a href="#" onClick="Game.buy('factories')">[Buy]</a> for <span id="price_factories"></span> credits?
			</li>
			<li id="infrastructure_labs">
				<strong id="owned_labs"></strong> labs | <a href="#" onClick="Game.buy('labs')">[Buy]</a> for <span id="price_labs"></span> credits?
			</li>
			<li id="infrastructure_banks">
				<strong id="owned_banks"></strong> banks | <a href="#" onClick="Game.buy('banks')">[Buy]</a> for <span id="price_banks"></span> credits?
			</li>
		</ul>
		
		<hr />
		
		<h3>Purchase Upgrades</h3>
		<ul id="upgrade_list">
			
		</ul>
		
	</div><!-- END <div id="upgrade_pane"> -->
		
	
	<div id="planet_pane">
		<span id="planet">
			<img src="<?php echo $baseUrl; ?>/images/fun/4x/starter_planet.png" />
		</span>
	</div> <!-- END <div id="planet_pane"> -->
	
</div>
