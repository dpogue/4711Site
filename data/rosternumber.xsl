<?xml version = "1.0"?>
<!-- rostername.xsl      -->

<xsl:stylesheet version = "1.0"
  xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">

    <xsl:template match = "/">
        <html>
            <body>
                <xsl:call-template name="table"/>
            </body>
        </html>
    </xsl:template>

    <xsl:template name ="startlist">
        <tr>
            <th>Jersey</th>
            <th>FirstName</th>	
			<th>LastName</th>
            <th>Position</th>
        </tr>
    </xsl:template>

    <xsl:template name ="list">
        <tr>
			<td>
                <xsl:value-of select = "@number"/>
            </td>
			<td>
                <xsl:value-of select = "@first"/>
			</td>
			<td>
				<xsl:value-of select = "@last"/>
			</td>
            <td>
                <xsl:value-of select = "@position"/>
            </td>
        </tr>
    </xsl:template>

    <xsl:template name="table">
        <table border = "1">
            <xsl:call-template name="startlist"/>
            <xsl:for-each select = "roster/player" >
                <xsl:sort select = "@number"/>
				<xsl:call-template name= "list"/>
            </xsl:for-each>
        </table>
        <br/>
    </xsl:template>

</xsl:stylesheet>
