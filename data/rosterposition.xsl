<?xml version = "1.0"?>
<!-- rostername.xsl      -->

<xsl:stylesheet version = "1.0"
  xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">

    <xsl:template match = "/">
        <html>
            <body>
				
				<fieldset><legend>Centers</legend>
                <xsl:call-template name="centers"/>
				</fieldset>
				<fieldset><legend>Right Wingers</legend>
                <xsl:call-template name="right"/>
				</fieldset>
				<fieldset><legend>Left Wingers</legend>
                <xsl:call-template name="left"/>
				</fieldset>
				<fieldset><legend>Defencemen</legend>
                <xsl:call-template name="defence"/>
				</fieldset>
				<fieldset><legend>Goalies</legend>
                <xsl:call-template name="goalies"/>
				</fieldset>
            </body>
        </html>
    </xsl:template>

    <xsl:template name ="startlist">
        <tr>
            <th>Jersey</th>
            <th>FirstName</th>	
			<th>LastName</th>
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
        </tr>
    </xsl:template>

    <xsl:template name="goalies">
        <table border = "1">
            <xsl:call-template name="startlist"/>
            <xsl:for-each select = "roster/player" >
                <xsl:sort select = "@last"/>
                <xsl:if test = "@position = 'G'">
                	<xsl:call-template name= "list"/>
                </xsl:if>
            </xsl:for-each>
        </table>
        <br/>
    </xsl:template>
	<xsl:template name="centers">
        <table border = "1">
            <xsl:call-template name="startlist"/>
            <xsl:for-each select = "roster/player" >
                <xsl:sort select = "@last"/>
                <xsl:if test = "@position = 'C'">
                	<xsl:call-template name= "list"/>
                </xsl:if>
            </xsl:for-each>
        </table>
        <br/>
    </xsl:template>
	<xsl:template name="defence">
        <table border = "1">
            <xsl:call-template name="startlist"/>
            <xsl:for-each select = "roster/player" >
                <xsl:sort select = "@last"/>
                <xsl:if test = "@position = 'D'">
                	<xsl:call-template name= "list"/>
                </xsl:if>
            </xsl:for-each>
        </table>
        <br/>
    </xsl:template>
	<xsl:template name="left">
        <table border = "1">
            <xsl:call-template name="startlist"/>
            <xsl:for-each select = "roster/player" >
                <xsl:sort select = "@last"/>
                <xsl:if test = "@position = 'LW'">
                	<xsl:call-template name= "list"/>
                </xsl:if>
            </xsl:for-each>
        </table>
        <br/>
    </xsl:template>
	<xsl:template name="right">
        <table border = "1">
            <xsl:call-template name="startlist"/>
            <xsl:for-each select = "roster/player" >
                <xsl:sort select = "@last"/>
                <xsl:if test = "@position = 'RW'">
                	<xsl:call-template name= "list"/>
                </xsl:if>
            </xsl:for-each>
        </table>
        <br/>
    </xsl:template>

</xsl:stylesheet>
