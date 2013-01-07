ALTER TABLE `#__coolfeed_style`
ADD `style_name` char (30);

UPDATE `#__coolfeed_style`
SET `style_name` = style_id;