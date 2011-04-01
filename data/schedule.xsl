<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:m="http://nyi.bcitxml.com/m">

<xsl:param name="order" />
<xsl:param name="day" />
<xsl:param name="month" />
<xsl:param name="year" />

<m:month name="JAN" value="1" />
<m:month name="FEB" value="2" />
<m:month name="MAR" value="3" />
<m:month name="APR" value="4" />
<m:month name="MAY" value="5" />
<m:month name="JUN" value="6" />
<m:month name="JUL" value="7" />
<m:month name="AUG" value="8" />
<m:month name="SEP" value="9" />
<m:month name="OCT" value="10" />
<m:month name="NOV" value="11" />
<m:month name="DEC" value="12" />

<xsl:template match="/">
<html>
<head>
    <meta charset="utf-8" />
    <title>NHL Schedule</title>
</head>
<body>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Visitors</th>
                <th>Home</th>
                <th>Time</th>
            </tr>
        </thead>
        <xsl:call-template name="schedule" />
    </table>
</body>
</html>
</xsl:template>

<xsl:template name="schedule">
    <xsl:for-each select="//game">
        <xsl:sort select="@year" order="ascending" data-type="number" />
        <xsl:sort select="document('')//m:month[@name=current()/@month]/@value" order="ascending" data-type="number" />
        <xsl:sort select="@day" order="ascending" data-type="number" />
        <xsl:choose>
            <xsl:when test="contains($order, 'old')">
                <xsl:if test="@year &lt; $year or (@year = $year and (document('')//m:month[@name=current()/@month]/@value &lt; document('')//m:month[@name=$month]/@value or (document('')//m:month[@name=current()/@month]/@value &lt;= document('')//m:month[@name=$month]/@value and @day &lt;= $day)))">
                    <xsl:apply-templates select="." />
                </xsl:if>
            </xsl:when>
            <xsl:when test="contains($order, 'upcoming')">
                <xsl:if test="@year &gt; $year or (@year = $year and (document('')//m:month[@name=current()/@month]/@value &gt; document('')//m:month[@name=$month]/@value or (document('')//m:month[@name=current()/@month]/@value &gt;= document('')//m:month[@name=$month]/@value and @day &gt;= $day)))">
                    <xsl:apply-templates select="." />
                </xsl:if>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="." />
            </xsl:otherwise>
        </xsl:choose>
    </xsl:for-each>
</xsl:template>

<xsl:template match="game">
        <tr>
            <td>
                <xsl:choose>
                    <xsl:when test="@month = 'JAN'">January </xsl:when>
                    <xsl:when test="@month = 'FEB'">February </xsl:when>
                    <xsl:when test="@month = 'MAR'">March </xsl:when>
                    <xsl:when test="@month = 'APR'">April </xsl:when>
                    <xsl:when test="@month = 'MAY'">May </xsl:when>
                    <xsl:when test="@month = 'JUN'">June </xsl:when>
                    <xsl:when test="@month = 'JUL'">July </xsl:when>
                    <xsl:when test="@month = 'AUG'">August </xsl:when>
                    <xsl:when test="@month = 'SEP'">September </xsl:when>
                    <xsl:when test="@month = 'OCT'">October </xsl:when>
                    <xsl:when test="@month = 'NOV'">November </xsl:when>
                    <xsl:when test="@month = 'DEC'">December </xsl:when>
                </xsl:choose> 
                <xsl:value-of select="@day" />, 
                <xsl:value-of select="@year" />
            </td>
            <td>
                <xsl:value-of select="./away" />
            </td>
            <td>
                <xsl:value-of select="./home" />
            </td>
            <td>
                <xsl:value-of select="@time" />
            </td>
        </tr>
</xsl:template>
</xsl:stylesheet>

