package httpserver
import (
    "net/http"
    "github.com/gin-gonic/gin"
)
func Start(addr string) error {
    r := gin.Default()
    r.GET("/healthz", func(c *gin.Context) { c.JSON(http.StatusOK, gin.H{"ok": true}) })
    r.POST("/v1/containers", createContainer)
    r.POST("/v1/containers/:uuid/start", startContainer)
    r.POST("/v1/containers/:uuid/stop", stopContainer)
    return r.Run(addr)
}