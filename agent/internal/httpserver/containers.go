package httpserver
import (
    "context"
    "net/http"
    "github.com/gin-gonic/gin"
)
type CreateReq struct {
    UUID   string            `json:"uuid"`
    Image  string            `json:"image"`
    Startup string           `json:"startup"`
    Env    map[string]string `json:"env"`
    Limits struct {
        CPU    int `json:"cpu"`
        RAMMb  int `json:"ram_mb"`
        DiskGb int `json:"disk_gb"`
    } `json:"limits"`
    Ports []int `json:"ports"`
}
func createContainer(c *gin.Context) {
    var req CreateReq
    if err := c.BindJSON(&req); err != nil { c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()}); return }
    c.JSON(http.StatusCreated, gin.H{"uuid": req.UUID, "status": "created"})
}
func startContainer(c *gin.Context) {
    uuid := c.Param("uuid"); _ = uuid
    c.JSON(http.StatusOK, gin.H{"uuid": uuid, "status": "started"})
}
func stopContainer(c *gin.Context) {
    uuid := c.Param("uuid"); _ = uuid
    c.JSON(http.StatusOK, gin.H{"uuid": uuid, "status": "stopped"})
}
func ctx() context.Context { return context.Background() }