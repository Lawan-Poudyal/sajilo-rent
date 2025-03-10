-- INSERT INTO review_house (`reviewer`, lat,lng,rating ,comment,date) VALUES
-- ('user21@gmail.com',27.62384735684541 ,85.53873690624236 ,4 ,'Nice experience overall','2025-03-01 09:20:00'), 
-- ('user22@gmail.com',27.62384735684541 ,85.53873690624236 ,4 ,'Comfortable stay','2025-03-02 15:55:00'), 
-- ('user23@gmail.com',27.62384735684541 ,85.53873690624236 ,3 ,'Decent facilities provided','2025-03-02 07:35:00'), 
-- ('user24@gmail.com',27.62384735684541 ,85.53873690624236 ,4 ,'Good enough for short stays','2025-03-04 18:45:00'), 
-- ('user25@gmail.com',27.62384735684541 ,85.53873690624236 ,5 ,'Would recommend to others!','2025-03-05 22:05:00');
-- -- Reviews for House of ramesh@hotmail.com (Average Rating :4)
-- INSERT INTO review_house (`reviewer`, lat,lng,rating ,comment,date) VALUES
--  ('user26@gmail.com',27.623747356845406 ,85.53893690624237 ,4 ,'Comfortable rooms ','2025 -03 -01   -09 :20 :00'), 
--  ('user27@gmail.com',27 .623747356845406 ,85 .53893690624237 ,3 ,'Decent stay ','2025 -03 -02   -18 :35 :00'), 
--  ('user28@gmail.com',27 .623747356845406 ,85 .53893690624237 ,4 ,'Nice amenities ','2025 -03 -03   -11 :45 :00'), 
--  ('user28@gmail.com',27 .623747356845406 ,85 .53893690624237 ,4 ,'Good overall experience ','2025 -03 -04   -19 :30 :00'), 
--  ('user29@gmail.com',27 .623747356845406 ,85 .53893690624237 ,4 ,'Would recommend to friends ','2025 -03 -05   -09 :20 :00');
-- -- Reviews for remaining houses (rita@yahoo.com [avg=3], sachin@gmail.com (avg=1), sunita@gmail.com (avg=3)) can be similarly created following the above examples clearly ensuring:
-- -- unique reviewers per house,
-- -- correct SQL syntax (no extra spaces or misplaced punctuation),
-- -- realistic timestamps.
SELECT *
FROM review_house