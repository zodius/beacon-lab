FROM golang:1.22-alpine AS builder
WORKDIR /app
COPY . .
RUN go build -o tcp-challenge .

FROM alpine:latest
WORKDIR /app
COPY --from=builder /app/tcp-challenge .
EXPOSE 8082
CMD ["./tcp-challenge"]