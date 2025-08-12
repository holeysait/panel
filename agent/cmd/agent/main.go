package main
import (
    "log"
    "os"
    "bspanel/agent/internal/httpserver"
)
func main() {
    addr := os.Getenv("AGENT_ADDR")
    if addr == "" { addr = ":8088" }
    log.Printf("Agent starting on %s", addr)
    if err := httpserver.Start(addr); err != nil { log.Fatal(err) }
}