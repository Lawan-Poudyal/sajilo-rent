-- SET @counter = 0;
-- UPDATE `LatLng`
-- SET `Images` = CASE 
--     WHEN (@counter := @counter + 1) % 3 = 1 THEN '../resources/rooms/room1.jpg'
--     WHEN (@counter := @counter + 1) % 3 = 2 THEN '../resources/rooms/room2.jpg'
--     ELSE '../resources/rooms/room3.jpg'
-- END;
-- select * from latlng
commit;