1)SELECT * from comment WHERE id_tweet = $id_tweet;
2)SELECT COUNT(id_like) AS 'nb de likes' FROM likes WHERE id_tweet= $id_tweet;