INSERT INTO `product_images` (`id`, `pid`, `name`, `created`, `modified`) 
VALUES ('1', '1', 'snowboard-1', '2019-02-04 12:00:00', CURRENT_TIMESTAMP), 
       ('2', '2', 'snowboard-2', '2019-02-04 12:30:00', CURRENT_TIMESTAMP);

INSERT INTO `products` (`pid`, `pname`, `pdesc`, `pprice`, `pcreated`, `pmodified`) 
VALUES ('1', 'snowboard-1', 'Burton Snowboard blue and black board only', '350.00', 
'2019-02-04 12:00:00', CURRENT_TIMESTAMP), 
('2', 'snowboard-2', 'Burton Snowboard board only Blue Black White Special Edition', 
'450.00', '2019-02-04 12:30:00', CURRENT_TIMESTAMP);

ALTER TABLE `product_images` 
ADD CONSTRAINT `FK_prodID` 
FOREIGN KEY (`pid`) 
REFERENCES `products`(`pid`) 
ON DELETE CASCADE 
ON UPDATE NO ACTION;