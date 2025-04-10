provider "azurerm" {
  features {}
  subscription_id = "af506d08-2a00-4e62-9aed-484bec1487f0"
  tenant_id       = "4fa1f4e8-4f5d-4edf-b24f-9d115fc33edb"
}
resource "random_id" "unique" {
  byte_length = 4
}


# Grupo de recursos
resource "azurerm_resource_group" "myproject_rg" {
  name     = "myproject-resources"
  location = "Central US"  # Cambia "West Europe" a "East US"
}

# Plan de servicio para la aplicación web
resource "azurerm_service_plan" "myproject_app_plan" {
  name                = "myproject-app-plan"
  resource_group_name = azurerm_resource_group.myproject_rg.name
  location            = "Central US"
  sku_name            = "B1"  # Cambiar el SKU de S1 a B1 o F1
  os_type             = "Windows"
}


# Aplicación web
resource "azurerm_windows_web_app" "myproject_webapp" {
  name                = "myproject-webapp"
  resource_group_name = azurerm_resource_group.myproject_rg.name
  location            = azurerm_service_plan.myproject_app_plan.location
  service_plan_id     = azurerm_service_plan.myproject_app_plan.id

  site_config {
    always_on = true
  }

  app_settings = {
    "DATABASE_URL" = "Server=${azurerm_mssql_server.myproject_sqlserver.fully_qualified_domain_name};Database=${azurerm_mssql_database.myproject_db.name};User Id=${azurerm_mssql_server.myproject_sqlserver.administrator_login};Password=${azurerm_mssql_server.myproject_sqlserver.administrator_login_password}"
  }
}

resource "azurerm_mssql_server" "myproject_sqlserver" {
  name                         = "myproject-sqlserver-${random_id.unique.hex}"
  resource_group_name          = azurerm_resource_group.myproject_rg.name
  location                     = azurerm_resource_group.myproject_rg.location
  version                      = "12.0"
  administrator_login          = "sqladmin"
  administrator_login_password = "YourSecurePassword123!"

  tags = {
    environment = "dev"
  }
}


# Base de datos SQL
resource "azurerm_mssql_database" "myproject_db" {
  name       = "myproject-db"
  server_id  = azurerm_mssql_server.myproject_sqlserver.id
  sku_name   = "Basic"

  depends_on = [azurerm_mssql_server.myproject_sqlserver]
}


