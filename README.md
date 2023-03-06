SQL structure

CREATE TABLE receipt (
receipt_id int(11) NOT NULL,
client_id int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE receipt
ADD PRIMARY KEY (receipt_id);

ALTER TABLE receipt
MODIFY receipt_id int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE receipt_to_dishes (
receipt_id int(11) NOT NULL,
dish_id int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;
