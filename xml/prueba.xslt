<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
xmlns:msxsl="urn:schemas-microsoft-com:xslt">

<xsl:template match="/">
<html>

  <h2>PARAMETROS EN XSL</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th>Param</th>
      <th>Value</th>
    </tr>
    <xsl:for-each select="ws_response/head/webmethod/parameters/parameter">
    <tr>
      <td><xsl:value-of select="name"/></td>
      <td><xsl:value-of select="value"/></td>
    </tr>
    </xsl:for-each>
  </table>

<!-- <script >
  <![CDATA[
  function alerta() {
  alert("prueba del xhtml");
  testeo();
  }
  ]]>
  </script> -->
<body>
<script>alerta()</script>
</body>
</html>

</xsl:template>

</xsl:stylesheet> 