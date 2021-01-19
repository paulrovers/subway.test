/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : subway

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 19/01/2021 11:06:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients`  (
                            `id` int(9) NOT NULL AUTO_INCREMENT,
                            `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
                            `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
                            `key` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
                            PRIMARY KEY (`id`, `key`) USING BTREE,
                            UNIQUE INDEX `key`(`key`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
                           `id` int(9) NOT NULL AUTO_INCREMENT,
                           `status` enum('open','closed') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
                           `date` datetime NULL DEFAULT CURRENT_TIMESTAMP,
                           `key` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
                           PRIMARY KEY (`id`, `key`) USING BTREE,
                           UNIQUE INDEX `key`(`key`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------


-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
                          `id` int(4) NOT NULL AUTO_INCREMENT,
                          `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `html_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
                          `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `category_id` int(4) NULL DEFAULT NULL,
                          `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES (1, 'Welcome at the subway test', 'Login details:<br>\r\n<br>\r\nemail: paul@jenda.nl<br>\r\npassword: admin<br>', '', 1, 'wow this meta desciption is awesome!', 'subway test', 'subway test');

-- ----------------------------
-- Table structure for sandwiches
-- ----------------------------
DROP TABLE IF EXISTS `sandwiches`;
CREATE TABLE `sandwiches`  (
                               `id` int(9) NOT NULL AUTO_INCREMENT,
                               `order_id` int(9) NOT NULL,
                               `client_id` int(9) NOT NULL,
                               `options` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
                               PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sandwiches
-- ----------------------------

-- ----------------------------
-- Table structure for sandwichoptions
-- ----------------------------
DROP TABLE IF EXISTS `sandwichoptions`;
CREATE TABLE `sandwichoptions`  (
                                    `id` int(9) NOT NULL AUTO_INCREMENT,
                                    `type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
                                    `options` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
                                    `fieldtype` enum('select','checkbox') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'select',
                                    PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sandwichoptions
-- ----------------------------
INSERT INTO `sandwichoptions` VALUES (1, 'breadtype', 'a:7:{i:0;s:11:\"Wheat Bread\";i:1;s:11:\"White Bread\";i:2;s:21:\"Italian Herb & Cheese\";i:3;s:10:\"Malted Rye\";i:4;s:4:\"Wrap\";i:5;s:16:\"Gluten Free Wrap\";i:6;s:15:\"Multigrain Wrap\";}', 'select');
INSERT INTO `sandwichoptions` VALUES (2, 'size', 'a:2:{i:0;s:4:\"15cm\";i:1;s:4:\"30cm\";}', 'select');
INSERT INTO `sandwichoptions` VALUES (3, 'ovenbaked', 'a:2:{i:0;s:3:\"yes\";i:1;s:2:\"no\";}', 'select');
INSERT INTO `sandwichoptions` VALUES (4, 'taste', 'a:7:{i:0;s:16:\"Steak and Cheese\";i:1;s:14:\"Spicey Italian\";i:2;s:22:\"Turkey & Bacon Avocado\";i:3;s:10:\"Roast Beef\";i:4;s:28:\"Sweet Onion Chicken Teriyaki\";i:5;s:11:\"Subway melt\";i:6;s:4:\"Tuna\";}', 'select');
INSERT INTO `sandwichoptions` VALUES (5, 'extras', 'a:3:{i:0;s:11:\"Extra Bacon\";i:1;s:11:\"Double Meat\";i:2;s:12:\"Extra Cheese\";}', 'checkbox');
INSERT INTO `sandwichoptions` VALUES (6, 'vegetables', 'a:8:{i:0;s:9:\"Cucumbers\";i:1;s:18:\"Green Bell Peppers\";i:2;s:7:\"Lettuce\";i:3;s:10:\"Red Onions\";i:4;s:8:\"Tomatoes\";i:5;s:12:\"Black Olives\";i:6;s:9:\"Jalapenos\";i:7;s:7:\"Pickles\";}', 'checkbox');
INSERT INTO `sandwichoptions` VALUES (7, 'sauce', 'a:6:{i:0;s:18:\"Chipotle Southwest\";i:1;s:18:\"Regular Mayonnaise\";i:2;s:13:\"Honey Mustard\";i:3;s:11:\"Sweet Onion\";i:4;s:10:\"Pesto Mayo\";i:5;s:18:\"Habanero Hot Sauce\";}', 'checkbox');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
                          `id` int(4) NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `password_reset_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `password_reset_expires_at` date NULL DEFAULT NULL,
                          `activation_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                          `is_active` int(1) NULL DEFAULT NULL,
                          PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Paul Rovers', 'paul@jenda.nl', '$2y$14$V/Tdj4j1m6iUj0u7znMUjOebrcDe6oIh4OSSoQVJfUR8iUUFUqr8u', NULL, NULL, NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;

