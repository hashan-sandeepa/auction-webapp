CREATE DATABASE IF NOT EXISTS `my_auction_db`;
USE `my_auction_db`;

CREATE TABLE `category`
(
    `id`   int         NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `category_name_unique` (`name`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 13;

INSERT INTO `category`
VALUES (1, 'Book'),
       (2, 'Computer'),
       (4, 'Electronic'),
       (12, 'Headset'),
       (7, 'Home & Garden'),
       (6, 'Jewelry'),
       (3, 'Mobile Phone'),
       (8, 'Musical Instrument'),
       (11, 'Shoe'),
       (9, 'Sport'),
       (5, 'T-Shirt'),
       (10, 'Watch');

CREATE TABLE `user`
(
    `id`                   int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name`           varchar(255) NOT NULL,
    `last_name`            varchar(255) NOT NULL,
    `email`                varchar(255) NOT NULL UNIQUE,
    `verification_code`    varchar(255) NOT NULL,
    `verification_expire`  timestamp    NULL     DEFAULT NULL,
    `is_verified`          tinyint(1)   NOT NULL DEFAULT '0',
    `profile_img_path`     varchar(255)          DEFAULT NULL,
    `contact_no`           varchar(255) NOT NULL UNIQUE,
    `password_reset_token` varchar(36)           DEFAULT NULL,
    `username`             varchar(255) NOT NULL UNIQUE,
    `password`             varchar(255) NOT NULL,
    `remember_token`       varchar(100)          DEFAULT NULL,
    `created_at`           timestamp    NULL     DEFAULT NULL,
    `updated_at`           timestamp    NULL     DEFAULT NULL
) ENGINE = InnoDB
  AUTO_INCREMENT = 3;

INSERT INTO `user`
VALUES (1, 'HaShaN', 'Sandeepa', 'hashans95@gmail.com', 'b5d4ee43323240f29968627fc20a9c78', NULL, 1,
        'profiles\\1/profile-photo.jpg', '0718761179', NULL, 'HaShaN',
        '$2y$10$bsPIRZ53KBRSblwkq7ZvgOjIjxxUK5z1uwr8lVy19zcAhNbVV7w6W',
        'RUeZAnixgaWMgzu072GHmSgXpEd0cs3N3JJrYCMJ5Z0dGLfPjWVPZpfgKLG5', NULL,
        '2018-10-05 05:31:15'),
       (2, 'HaShaN', 'Sandeepa', 'hashans96@gmail.com', 'b5d4ee43323240f29968627fc20a9c78', NULL, 1,
        'profiles\\1/profile-photo.jpg', '0778761179', NULL, 'HaShaN1',
        '$2y$10$hPUuG7/1JH5.JypLiXPAreWKJArKu07mpgVVcc8IiLZYmZ3mQlU0W',
        'rmkj2vWL8xOS23bxPjv56ARio1TOuOiFw8o3qgPDUBw5ntIbYvRd1GkEdyiK', '2018-10-04 09:55:46',
        '2018-10-04 09:55:45');

CREATE TABLE `auction`
(
    `id`           int            NOT NULL AUTO_INCREMENT,
    `user_id`      int            NOT NULL,
    `title`        varchar(100)   NOT NULL,
    `category_id`  int            NOT NULL,
    `description`  varchar(1000)  NOT NULL,
    `image_paths`  mediumtext,
    `starting_bid` decimal(11, 2) NOT NULL,
    `start_at`     timestamp      NULL DEFAULT NULL,
    `end_at`       timestamp      NULL DEFAULT NULL,
    `created_at`   timestamp      NULL DEFAULT NULL,
    `updated_at`   timestamp      NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `auction_user_id_foreign` (`user_id`),
    KEY `auction_category_id_foreign` (`category_id`),
    CONSTRAINT `auction_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
    CONSTRAINT `auction_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7;

INSERT INTO `auction`
VALUES (1, 1, 'Samsung S9', 3,
        'Released 2018, March 163g, 8.5mm thickness Android 8.0 64/128/256GB storage, microSD card slot',
        'auctions/3/auction-photo-4.jpg|auctions/3/auction-photo-1.jpg|auctions/3/auction-photo-2.jpg|auctions/3/auction-photo-3.jpg',
        479.00, '2018-10-07 02:40:00', '2018-10-12 06:37:00', NULL, NULL),
       (2, 1, 'Adidas Originals', 5,
        'This t-shirt spells out your pride in Juventus winning brand of soccer. Made from soft single jersey fabric, it displays an oversize club badge on the back.Regular fit is wider at the body, with a straight silhouette Imported 100% cotton single jersey',
        'auctions/2/auction-photo-1.jpg|auctions/2/auction-photo-2.jpg|auctions/2/auction-photo-3.jpg|auctions/2/auction-photo-4.jpg',
        20.00, '2018-10-02 13:34:00', '2018-10-14 13:37:00', NULL, NULL),
       (3, 1, 'Dell XPS 13', 2,
        'The smallest 13.3-inch on the planet with the world’s first InfinityEdge display More screen, less to carry: The virtually borderless InfinityEdge display maximizes screen space by squeezing a 13.3-inch display in an 11-inch frame. With a bezel only 5.2 mm thin, starting at only 2.7 pounds and measuring a super slim 9-15 mm, the XPS 13 is exceptionally thin and light.',
        'auctions/1/auction-photo-1.jpg', 698.00, '2018-10-06 02:36:00', '2018-10-15 03:35:00',
        NULL, NULL),
       (4, 1, 'Nike Sport Shoe', 11,
        'Beveled heel and rubber outsole strip help you land in a good position and transition smoothly\r\nRaised rubber sections on the bottom of the shoe provide traction\r\nOffset: 10mm\r\nShown: Barely Grey/Geode Teal/Black/Hot Punch\r\nStyle: AV2320-063',
        'auctions/4/auction-photo-1.jpg|auctions/4/auction-photo-2.jpg', 80.00,
        '2018-10-02 09:59:29', '2018-10-08 09:59:31', NULL, NULL),
       (5, 1, 'Apple Watch Series 3', 10,
        '➤ Apple Watch Series 3 42mm GPS ONLY\r\n➤ MQL12LL/A Space Gray Aluminum Case with Black Sports Band\r\n➤ Built-in GPS and GLONASS\r\n➤ Water resistant 50 meters2\r\n➤ Up to 18 hours of battery life3',
        'auctions/5/auction-photo-1.jpg', 1250.00, '2018-10-03 10:02:36', '2018-10-22 10:02:40',
        NULL, NULL),
       (6, 1, 'Beats Studio3', 12,
        'Pure adaptive noise canceling (pure ANC) actively blocks external noise\r\nReal-time Audio calibration preserves a Premium listening experience\r\nUp to 22 hours of battery life enables full-featured all-day wireless playback\r\nApple W1 chip for class 1 wireless Bluetooth connectivity & battery efficiency\r\nWith fast Fuel, a 10-minute charge gives 3 hours of play when battery is low',
        'auctions/6/auction-photo-1.jpg', 310.00, '2018-10-06 10:06:16', '2018-10-22 10:06:19',
        NULL, NULL);

CREATE TABLE `bid`
(
    `id`         int            NOT NULL AUTO_INCREMENT,
    `auction_id` int            NOT NULL,
    `user_id`    int            NOT NULL,
    `amount`     decimal(11, 2) NOT NULL,
    `created_at` timestamp      NULL DEFAULT NULL,
    `updated_at` timestamp      NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `bid_auction_id_foreign` (`auction_id`),
    KEY `bid_user_id_foreign` (`user_id`),
    CONSTRAINT `bid_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`id`) ON DELETE CASCADE,
    CONSTRAINT `bid_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 12;

INSERT INTO `bid`
VALUES (2, 1, 1, 480.00, '2018-10-04 14:23:37', '2018-10-04 14:23:37'),
       (3, 1, 1, 481.00, '2018-10-04 09:43:33', '2018-10-04 09:43:35'),
       (4, 2, 1, 22.00, '2018-10-04 09:43:54', '2018-10-04 09:43:56'),
       (5, 2, 1, 25.00, '2018-10-04 09:44:17', '2018-10-04 09:44:19'),
       (6, 1, 1, 482.00, '2018-10-04 09:44:48', '2018-10-04 09:44:49'),
       (7, 1, 2, 483.00, '2018-10-04 15:29:30', '2018-10-04 15:29:30'),
       (8, 1, 2, 484.50, '2018-10-04 15:32:09', '2018-10-04 15:32:09'),
       (9, 1, 1, 485.00, '2018-10-04 15:37:27', '2018-10-04 15:37:27'),
       (10, 1, 2, 486.00, '2018-10-04 15:38:24', '2018-10-04 15:38:24'),
       (11, 1, 1, 486.75, '2018-10-04 15:40:33', '2018-10-04 15:40:33');
