<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML>
	<BODY>
		<table border="1">
				<tr>
					<th>Autor</th>
					<th>Enunciado</th>
					<th>Respuesta correcta</th>
					<th>Respuestas incorrectas</th>
					<th>Complejidad</th>
					<th>Tema</th>
				</tr>
			<xsl:for-each select="assessmentItems/assessmentItem">
				<tr>
					<td><FONT SIZE="2" COLOR="red"/><xsl:value-of select="@author"/></td>
					<td><FONT SIZE="2" COLOR="red"/><xsl:value-of select="itemBody/p"/></td>
					<td><FONT SIZE="2" COLOR="red"/><xsl:value-of select="correctResponse/value"/></td>
					<td><ul>
						<xsl:for-each select="incorrectResponses/value">
							<li><FONT SIZE="2" COLOR="red"/><xsl:value-of select="text()"/></li>
						</xsl:for-each>
						</ul>
					</td>
					<td><FONT SIZE="2" COLOR="red"/><xsl:value-of select="@complexity"/></td>
					<td><FONT SIZE="2" COLOR="red"/><xsl:value-of select="@subject"/></td>
				</tr>
			</xsl:for-each>
		</table>
	</BODY>
</HTML>
</xsl:template>
</xsl:stylesheet>



