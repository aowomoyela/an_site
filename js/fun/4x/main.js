/***********************/
/* Game Initialization */
/***********************/

Game={};

Game.newGame = function() {
	// Starting stats.
	Game.industry = 0;
	Game.economy = .1;
	Game.science = 0;
	Game.growth = .05;
	Game.population = 1000000000;
	Game.money = 100;
	Game.social = 0;
	Game.techLevel = 1;
	
	// Starting infrastructure
	Game.infrastructure = {};
	Game.infrastructure.factories = 0;
	Game.infrastructure.labs = 0;
	Game.infrastructure.banks = 0;
	
	// Starting bonuses
	Game.bonuses = {};
	Game.bonuses.factories = .1;
	Game.bonuses.labs = .1;
	Game.bonuses.banks = .1;
	
	// Starting prices
	Game.prices = {};
	Game.prices.factories = 100;
	Game.prices.labs = 100;
	Game.prices.banks = 100;
	
	Game.priceGrowth = {};
	Game.priceGrowth.factories = 1.05;
	Game.priceGrowth.labs = 1.05;
	Game.priceGrowth.banks = 1.05;
	
	
	// Starting upgrades
	Game.upgrades = {};
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


/*****************/
/* Stat handling */
/*****************/

Game.getRealEconomy = function() {
	realEconomy = Game.economy;
	// Base effect of banks on economy
	realEconomy += .1 * Game.infrastructure.banks;
	// Return calculated economy score.
	return realEconomy;
}

Game.getRealIndustry = function() {
	realIndustry = Game.industry;
	// Base effect of factories on industry
	realIndustry += .1 * Game.infrastructure.factories;
	// Return calculated industry score.
	return realIndustry;
}

Game.getRealScience = function() {
	realScience = Game.science;
	// Base effect of labs on science
	realScience += .1 * Game.infrastructure.labs;
	// Return calculated industry score.
	return realScience;
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

Game.getDisplayMoney = function() {
	displayMoney = Game.money.toFixed(1).toString() + ' credits';
	return displayMoney;
}

Game.getDisplayGrowth = function() {
	displayGrowth = Game.growth.toString() + "%";
	return displayGrowth;
}

Game.getDisplayIndustry = function() {
	displayIndustry = Game.getRealIndustry().toString();
	return displayIndustry;
}

Game.getDisplayEconomy = function() {
	displayEconomy = Game.getRealEconomy().toString();
	return displayEconomy;
}

Game.getDisplayScience = function() {
	displayScience = Game.getRealScience().toString();
	return displayScience;
}

/* Stat section updates */

Game.updateTurnStatDisplay = function() {
	$("#4x_stat_population").html( Game.getDisplayPopulation() );
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
				// Update the factory price and factory number in the infrastructure list.
				Game.updateInfrastructureDisplay();
				Game.updateGameStatDisplay();
				// Update the industry stat.
				
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
				// Update the lab price and lab number in the infrastructure list.
				Game.updateInfrastructureDisplay();
				Game.updateGameStatDisplay();
				// Update the science stat.
				
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
				// Update the bank price and bank number in the infrastructure list.
				Game.updateInfrastructureDisplay();
				Game.updateGameStatDisplay();
				// Update the economy stat.
				
			} else {
				// No can buy. THERE IS NO NATIONAL DEBT.
				alert("You don't have the money for that!");
			}
		break;
		
		
	}
}


/********************/
/* Upgrade Handling */
/********************/

// STUFF.


/*****************/
/* Turn Handling */
/*****************/
// A turn is hereby declared to be 1 second because YOLO

Game.nextTurn = function() {
	Game.population += Game.population*Game.growth/100;
	Game.money += Game.getRealEconomy();
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