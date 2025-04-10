output "web_app_url" {
  value = azurerm_windows_web_app.myproject_webapp.default_hostname
}

output "database_connection" {
  value = "Server=${azurerm_mssql_server.myproject_sqlserver.fully_qualified_domain_name};Database=${azurerm_mssql_database.myproject_db.name};User Id=${azurerm_mssql_server.myproject_sqlserver.administrator_login};Password=${azurerm_mssql_server.myproject_sqlserver.administrator_login_password}"
  sensitive = true
}
