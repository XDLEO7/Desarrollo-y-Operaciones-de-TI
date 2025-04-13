<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Informe Final - Proyecto Azure</title>
  <link rel="stylesheet" href="styles.css"> <!-- Aquí puedes agregar estilos -->
</head>
<body>

  <header>
    <h1>Informe Final del Proyecto</h1>
    <h2>Despliegue de Infraestructura en Azure con Terraform</h2>
  </header>

  <section id="introduccion">
    <h2>2.1 Introducción y Objetivos del Proyecto</h2>
    <p>Este proyecto tiene como objetivo desplegar una infraestructura en la nube utilizando Microsoft Azure y Terraform. Se busca aplicar conocimientos de Infraestructura como Código (IaC) y servicios cloud para automatizar el aprovisionamiento de recursos.</p>
  </section>

  <section id="diseno">
    <h2>2.2 Diseño de la Solución</h2>
    <p>La solución contempla los siguientes componentes:</p>
    <ul>
      <li>Grupo de recursos en Azure</li>
      <li>Plan de servicio de aplicaciones (Service Plan)</li>
      <li>Aplicación web basada en Windows</li>
      <li>Servidor de base de datos MSSQL</li>
      <li>Base de datos SQL</li>
    </ul>
    <p>Se optó por regiones económicas como <em>Central US</em> y planes básicos para minimizar costos.</p>
  </section>

  <section id="implementacion">
    <h2>2.3 Implementación</h2>
    <p>El despliegue se realizó mediante Terraform. A continuación se muestra un fragmento del código:</p>
    <pre><code>
provider "azurerm" {
  features {}
  subscription_id = "XXXX"
  tenant_id       = "XXXX"
}

resource "azurerm_resource_group" "myproject_rg" {
  name     = "myproject-resources"
  location = "Central US"
}
    </code></pre>
    <p>El código completo está disponible en el repositorio del proyecto (o adjunto al informe).</p>
  </section>

  <section id="pruebas">
    <h2>2.4 Pruebas y Resultados</h2>
    <p>Se validó que todos los recursos se crearan correctamente mediante el portal de Azure. También se verificó el acceso a la aplicación web desplegada, así como la conectividad con la base de datos SQL.</p>
  </section>

  <section id="conclusiones">
    <h2>2.5 Conclusiones y Lecciones Aprendidas</h2>
    <ul>
      <li>Terraform facilita el despliegue repetible de infraestructura.</li>
      <li>Es importante manejar de forma segura las credenciales y configuraciones sensibles.</li>
      <li>El trabajo en equipo y la documentación clara fueron clave para el éxito del proyecto.</li>
    </ul>
  </section>

  <section id="referencias">
    <h2>2.6 Referencias Bibliográficas</h2>
    <ul>
      <li>HashiCorp. (n.d.). *Terraform by HashiCorp*. https://www.terraform.io/</li>
      <li>Microsoft. (n.d.). *Azure Resource Manager documentation*. https://learn.microsoft.com/en-us/azure/azure-resource-manager/</li>
    </ul>
  </section>

  <footer>
    <p>Proyecto elaborado por: Grupo N° X</p>
  </footer>

</body>
</html>
