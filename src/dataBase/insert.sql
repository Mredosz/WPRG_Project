# Category
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Most Popular','FOOD-NAME-51.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Breakfast','FOOD-NAME-1731.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Lunch','FOOD-NAME-4678.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Dinner','FOOD-NAME-642.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Dessert','FOOD-NAME-6502.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Salads','FOOD-NAME-6890.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Drinks','FOOD-NAME-4972.jpg','1');
INSERT INTO `category`(`categoryID`, `name`, `imageName`, `statusCategory`) VALUES ('','Dinner Set','FOOD-NAME-1050.jpg','1');

# Rola
INSERT INTO `rola`(`rolaID`, `name`) VALUES ('','guest');
INSERT INTO `rola`(`rolaID`, `name`) VALUES ('','user');
INSERT INTO `rola`(`rolaID`, `name`) VALUES ('','admin');

# User
INSERT INTO `users`(`usersID`, `rolaID`, `firstName`, `lastName`, `email`, `password`) VALUES ('','1','','','','');

# Breakfast
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
                ('','2','Three Pancakes','8','1','Three large cakes made with a buttermilk batter.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','2','French Toast','9.5','1','Three slices of Texas toast dipped in a buttermilk batter and fried.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','2','USA Breakfast','9.87','1','Two eggs any style, with bacon or sausage links and a side of two potato pancakes.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','2','Farmer''s Sandwich','8.15','1','Fried egg with bacon, ham, or sausage and cheese on French bread, served with hash browns or american fries.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','2','Polish Skillet','11.89','1','With onions, green peppers, American cheese, and Polish sausage.
Served with two eggs any style, diced potatoes, and toast.');

# Lunch
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','3','Italian Beef','7.56','1','Thin sliced beef on French bread with au jus.
Served with french fries or potato salad, and soup of the day.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','3','Polish Sausage','8.5','1','Grilled Polish sausage and sauerkraut on French bread.
Served with french fries or potato salad, and soup of the day.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','3','Turkey Melt','6.89','1','Sliced turkey and Swiss cheese served on rye bread.
Served with french fries or potato salad, and soup of the day.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','3','Bacon Cheeseburger','10.27','1','With bacon and American cheese on a toasted bun.
Served with french fries or potato salad, and soup of the day.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','3','Italian Wrap','11.10','1','With green peppers, onions, tomatoes, Italian sausage,
            marinara sauce and mozzarella cheese, rolled in a large flour tortilla.');

# Dinner
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','4','Fried Mushrooms','4.20','1','A large basket of mushrooms, available with ranch. Great for two!
Additional sauces extra.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','4','Spaghetti','8.78','1','Served with or without meatballs, in a casserole
with our rich meat sauce, garlic bread, and lots of mozzarella cheese.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','4','Fried One-Half Chicken','7.15','1','Allow 20 minutes cooking time.
Includes a wing, a breast, a thigh, and a leg all deep fried to an exceptional golden brown.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','4','Steak Teriyaki','9.11','1','Strips of sirloin marinated in teriyaki sauce
Served with choice of potato or rice, and choice of salad or soup of the day.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','4','Pork Chops','12.37','1','Two thick cut chops, broiled to perfection.
Served with choice of potato or rice, and choice of salad or soup of the day.');

# Dessert
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','5','Ice Cream','6.73','1','Choose from chocolate, vanilla, strawberry, peppermint, butter pecan, or spumoni.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','5','Triple Thick Milkshakes','8.99','1','Hand-blended milkshakes available in chocolate, vanilla, or strawberry.
Each shake is individually made, please allow a few extra minutes when ordered.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','5','New York Style Cheesecake','7.97','1','Our homemade cheesecake, and our most popular dessert.
Add strawberries, cherries, or blueberries for an extra special treat!');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','5','Pumpkin Pie','9.12','1','When in season.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','5','Chocolate Oreo Cream','6.49','1','');

# Salads
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','6','Caesar Salad','7.42','1','Chicken breast with fresh romaine lettuce mixed our own
Caesar dressing and parmesan cheese, tomatoes, and a hard boiled egg.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','6','Grecian Salata','4.21','1','Crisp green lettuce, with onions, feta cheese, anchovies, black olives, and tomatoes.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','6','California Fruit Plate','9.97','1','With cottage cheese, tropical fruit, peaches, raisin toast, and jello for dessert!');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','6','Stuffed Tomato','6.74','1','With chicken or tuna salad, cottage cheese, and a hard boiled egg.');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','6','Crabmeat Julienne','8.23','1','With tomato, cucumber, crabmeat, and a hard boiled egg.');

# Drinks
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','7','Coca Cola Zero','3.99','1','0.5l');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','7','Sprite','2.10','1','0.33l');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','7','Coffee','3.50','1','Dark coffee');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','7','Water','1.99','1','1l');
INSERT INTO `item`(`itemID`, `categoryID`, `name`, `price`, `status`, `description`) VALUES
    ('','7','Orange Juice','2.34','1','1l');

# Meat
INSERT INTO `meat`(`meatID`, `name`, `price`) VALUES ('','Pork chop','2');
INSERT INTO `meat`(`meatID`, `name`, `price`) VALUES ('','Pork neck','2.5');
INSERT INTO `meat`(`meatID`, `name`, `price`) VALUES ('','Devolies','3');
INSERT INTO `meat`(`meatID`, `name`, `price`) VALUES ('','Chicken fillet','3.23');
INSERT INTO `meat`(`meatID`, `name`, `price`) VALUES ('','Gyros baked with cheese','5');

# Extras
INSERT INTO `extras`(`extrasID`, `name`, `price`) VALUES ('','Rice','1.87');
INSERT INTO `extras`(`extrasID`, `name`, `price`) VALUES ('','Potatoes','2.3');
INSERT INTO `extras`(`extrasID`, `name`, `price`) VALUES ('','Fries','2.5');
INSERT INTO `extras`(`extrasID`, `name`, `price`) VALUES ('','Groats','2.2');
INSERT INTO `extras`(`extrasID`, `name`, `price`) VALUES ('','Baked potatoes','2.5');

#Salads
INSERT INTO `salads`(`saladsID`, `name`, `price`) VALUES ('','Carrot salad','2.10');
INSERT INTO `salads`(`saladsID`, `name`, `price`) VALUES ('','Barracks salad','1.99');
INSERT INTO `salads`(`saladsID`, `name`, `price`) VALUES ('','Coleslaw','2.89');
INSERT INTO `salads`(`saladsID`, `name`, `price`) VALUES ('','Bouquet of salads','3');
INSERT INTO `salads`(`saladsID`, `name`, `price`) VALUES ('','Boiled vegetables','2.99');