DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_aumenta_precio`(IN `v_editorial` VARCHAR(100), IN `v_aumento` INT(10))
BEGIN

SET @multi := 1 + (v_aumento / 100) ;

select @multi;

UPDATE libros set precio = precio * @multi where editorial=v_editorial;


END$$
DELIMITER ;