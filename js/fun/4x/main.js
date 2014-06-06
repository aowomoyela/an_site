/***********************/
/* Game Initialization */
/***********************/

Game={};

Game.newGame = function() {
	// Starting base stats.
	Game.baseStat = {};
	Game.baseStat.industry = .1;
	Game.baseStat.economy = .1;
	Game.baseStat.science = .1;
	Game.baseStat.growth = .05;
	Game.baseStat.population = 1000000000;
	Game.baseStat.money = 100;
	Game.baseStat.social = 0;
	Game.baseStat.techLevel = 1;
	Game.baseStat.maxPopulation = 10000000000;
	
	// Starting multipliers
	Game.multipliers = {};
	Game.multipliers.industry = 1;
	Game.multipliers.science = 1;
	Game.multipliers.economy = 1;
	
	// Starting stats.
	Game.industry = 0;
	Game.economy = .1;
	Game.science = 0;
	Game.growth = .05;
	Game.population = 1000000000;
	Game.money = 100;
	Game.social = 0;
	Game.techLevel = 1;
	Game.maxPopulation = 10000000000;
	
	// Starting infrastructure
	Game.infrastructure = {};
	Game.infrastructure.factories = 0;
	Game.infrastructure.labs = 0;
	Game.infrastructure.banks = 1;
	
	// Starting prices
	Game.prices = {};
	Game.prices.factories = 100;
	Game.prices.labs = 100;
	Game.prices.banks = 100;
	
	Game.priceGrowth = {};
	Game.priceGrowth.factories = 1.15;
	Game.priceGrowth.labs = 1.15;
	Game.priceGrowth.banks = 1.15;
}

Game.loadGame = function() {
	// Check for a saved game in cookies.  If no game, start a new one.
	if (false) {
		// ...well, we'll get to cookies EVENTUALLY...
		alert("This should never appear.");
	} else {
		Game.newGame();
	}
}


/*************************/
/* Stat display handling */
/*************************/

/* Individual display stats */

Game.getDisplayPopulation = function() {
	displayPopulation = Game.population/1000000000;
	displayPopulation = displayPopulation.toFixed(3) + ' billion';
	return displayPopulation;
}

Game.getDisplayMaxPopulation = function() {
	displayMaxPopulation = Game.maxPopulation/1000000000;
	displayMaxPopulation = displayMaxPopulation.toFixed(3) + ' billion';
	return displayMaxPopulation;
}

Game.getDisplayMoney = function() {
	displayMoney = Game.money.toFixed(1).toString() + ' credits';
	return displayMoney;
}

Game.getDisplayGrowth = function() {
	displayGrowth = Game.growth.toString() + "%";
	return displayGrowth;
}

Game.getDisplayIndustry = function() {
	displayIndustry = Game.industry.toFixed(1).toString();
	return displayIndustry;
}

Game.getDisplayEconomy = function() {
	displayEconomy = Game.economy.toFixed(1).toString();
	return displayEconomy;
}

Game.getDisplayScience = function() {
	displayScience = Game.science.toFixed(1).toString();
	return displayScience;
}

/* Stat section updates */

Game.updateTurnStatDisplay = function() {
	$("#4x_stat_population").html( Game.getDisplayPopulation() );
	$("#4x_stat_max_population").html( Game.getDisplayMaxPopulation() );
	$("#4x_stat_money").html( Game.getDisplayMoney() );
}

Game.updateGameStatDisplay = function() {
	$("#4x_stat_industry").html( Game.getDisplayIndustry() );
	$("#4x_stat_science").html( Game.getDisplayScience() );
	$("#4x_stat_economy").html( Game.getDisplayEconomy() );
	$("#4x_stat_growth").html( Game.getDisplayGrowth() );
	$("#4x_stat_social").html( Game.social.toString() );
}

Game.updateInfrastructureDisplay = function() {
	$("#owned_factories").html(Game.infrastructure.factories.toString());
	$("#price_factories").html(Game.prices.factories.toString());
	
	$("#owned_labs").html(Game.infrastructure.labs.toString());
	$("#price_labs").html(Game.prices.labs.toString());
	
	$("#owned_banks").html(Game.infrastructure.banks.toString());
	$("#price_banks").html(Game.prices.banks.toString());
}


/***************************/
/* Infrastructure Handling */
/***************************/

Game.buy = function(infrastructure) {
	switch (infrastructure) {
		case "factories":
			// Is there enough money in the player's bank?
			if (Game.money >= Game.prices.factories) {
				// Subtract the purchase price from the bank, add a factory, and up the purchase price.
				Game.money -= Game.prices.factories;
				Game.infrastructure.factories++;
				Game.prices.factories *= Game.priceGrowth.factories;
				Game.prices.factories = Game.prices.factories.toFixed(0);
				// Update the industry stat.
				Game.recalculateStat("industry");
				// Update the factory price and factory number in the infrastructure list.
				Game.updateInfrastructureDisplay();
				Game.updateGameStatDisplay();
			} else {
				// No can buy. THERE IS NO NATIONAL DEBT.
				alert("You don't have the money for that!");
			}
		break;
		
		case "labs":
			// Is there enough money in the player's bank?
			if (Game.money >= Game.prices.labs) {
				// Subtract the purchase price from the bank, add a lab, and up the purchase price.
				Game.money -= Game.prices.labs;
				Game.infrastructure.labs++;
				Game.prices.labs *= Game.priceGrowth.labs;
				Game.prices.labs = Game.prices.labs.toFixed(0);
				// Update the science stat.
				Game.recalculateStat("science");
				// Update the lab price and lab number in the infrastructure list.
				Game.updateInfrastructureDisplay();
				Game.updateGameStatDisplay();
			} else {
				// No can buy. THERE IS NO NATIONAL DEBT.
				alert("You don't have the money for that!");
			}
		break;
		
		case "banks":
			// Is there enough money in the player's bank?
			if (Game.money >= Game.prices.banks) {
				// Subtract the purchase price from the bank, add a bank, and up the purchase price.
				Game.money -= Game.prices.banks;
				Game.infrastructure.banks++;
				Game.prices.banks *= Game.priceGrowth.banks;
				Game.prices.banks = Game.prices.banks.toFixed(0);
				// Update the economy stat.
				Game.recalculateStat("economy");
				// Update the bank price and bank number in the infrastructure list.
				Game.updateInfrastructureDisplay();
				Game.updateTurnStatDisplay();
				Game.updateGameStatDisplay();
			} else {
				// No can buy. THERE IS NO NATIONAL DEBT.
				alert("You don't have the money for that!");
			}
		break;
		
		
	}
}


// Recalculate "real" stat levels. Call this after every relevant purchase.
Game.recalculateStat = function(stat) {
	switch (stat) {
		case "industry":
			indPopulationBonus = (Game.population/1000000000);
			Game.industry = Game.infrastructure.factories * Game.baseStat.industry * Game.multipliers.industry * indPopulationBonus;
		break;
		
		case "science":
			sciPopulationBonus = (Game.population/1000000000);
			Game.science = Game.infrastructure.labs * Game.baseStat.science * Game.multipliers.science * sciPopulationBonus;
		break;
		
		case "economy":
			ecnPopulationBonus = (Game.population/1000000000);
			Game.economy = Game.infrastructure.banks * Game.baseStat.economy * Game.multipliers.economy * ecnPopulationBonus;
		break;
	} // END switch (stat)
}


/********************/
/* Upgrade Handling */
/********************/

/*Game.upgrades = {};
Game.upgrades.available = {};
Game.upgrades.unavailable = {};
Game.upgrades.purchased = {};

// Break up upgrades depending on what unlocks them, so iteration can happen in chunks.
// These happen when you purchase infrastructure.
Game.upgrades.unavailable.banksUnlock = {};
Game.upgrades.unavailable.factoriesUnlock = {};
Game.upgrades.unavailable.labsUnlock = {};
// These happen every minute.
Game.upgrades.unavailable.techLevelUnlock = {};
Game.upgrades.unavailable.scienceUnlock = {};
Game.upgrades.unavailable.industryUnlock = {};
Game.upgrades.unavailable.moneyUnlock = {};
Game.upgrades.unavailable.socialUnlock = {};*/


/*****************/
/* Turn Handling */
/*****************/
// A turn is hereby declared to be 1 second because YOLO

Game.nextTurn = function() {
	if (Game.population < Game.maxPopulation) {
		Game.population += Game.population*Game.growth/100;
	}
	Game.money += Game.economy;
}


/*************/
/* Game Loop */
/*************/
$( document ).ready(function() {
	Game.loadGame();
	Game.updateGameStatDisplay();
	Game.updateTurnStatDisplay();
	Game.updateInfrastructureDisplay();
			 
	setInterval(function() {
		Game.nextTurn();
	    Game.updateTurnStatDisplay();
	}, 1000);
	
	setInterval(function() {
	    // Do some things every minute.
	}, 1000*60);
});