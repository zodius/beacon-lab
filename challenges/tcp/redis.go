package main

import (
	"context"

	"github.com/redis/go-redis/v9"
)

type RedisRepo struct {
	RDB redis.Client
}

func (r *RedisRepo) Connect(addr string) error {
	r.RDB = *redis.NewClient(&redis.Options{
		Addr:     addr,
		Password: "",
		DB:       0,
	})
	_, err := r.RDB.Ping(context.Background()).Result()
	return err
}

func (r *RedisRepo) GetAnswer(userid [16]byte) ([]byte, error) {
	key := "shellcode:tcp:" + string(userid[:])
	val, err := r.RDB.Get(context.Background(), key).Bytes()
	return val, err
}
