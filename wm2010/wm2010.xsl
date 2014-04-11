<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <table width="1200" border="0" cellspacing="1" cellpadding="1">
        <tr>
        <td width="400">
          <table border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td>
                <h2>Expertenkommentar:</h2></td>
            </tr>
            <tr>
              <td>
                <h3><xsl:value-of select="Spiele/Kommentar"/>
                </h3>
              </td>
            </tr>
            <tr>
              <td>
                <h5>MfG, euer Experte!</h5></td>
            </tr>
          </table>
        </td>
          <td width="400">          
  <table border="1" cellspacing="1" cellpadding="1">
    <tr>
        <th colspan="5"><h1>Punktestand</h1></th>
      </tr>
        <tr bgcolor="#FF9933">
          <th>Platz</th>
          <th>Name</th>
          <th>Weltmeistertipp</th>
          <th>5 €</th>
          <th>Punktestand</th>
      </tr>
    <xsl:for-each select="Spiele/Spieler">
      <xsl:sort select="Punkte" order="descending" data-type="number"/>
      <xsl:choose>
        <xsl:when test="Platz = '1'">
          <tr STYLE="text-align:center">
            <TD STYLE="background-color:#FFEFAF">
              <xsl:value-of select="Platz"/>
            </TD>
            <TD STYLE="background-color:#FFEFAF">
              <xsl:value-of select="Name"/>
            </TD>
            <TD STYLE="background-color:#FFEFAF">
              <xsl:value-of select="Weltmeister"/>
            </TD>
            <TD STYLE="background-color:#FFEFAF">
              <xsl:value-of select="Geld"/>
            </TD>
            <TD STYLE="background-color:#FFEFAF">
              <xsl:value-of select="Punkte"/>
            </TD>
          </tr>
        </xsl:when>
        <xsl:when test="Platz = '2'">
        <tr STYLE="text-align:center">
          <TD STYLE="background-color:#FFF9C4">
            <xsl:value-of select="Platz"/>
          </TD>
          <TD STYLE="background-color:#FFF9C4">
            <xsl:value-of select="Name"/>
          </TD>
          <TD STYLE="background-color:#FFF9C4">
            <xsl:value-of select="Weltmeister"/>
          </TD>
          <TD STYLE="background-color:#FFF9C4">
            <xsl:value-of select="Geld"/>
          </TD>
          <TD STYLE="background-color:#FFF9C4">
            <xsl:value-of select="Punkte"/>
          </TD>
        </tr>
        </xsl:when>
      <xsl:otherwise>
        <tr STYLE="text-align:center">
          <TD STYLE="background-color:#FFF5F5">
            <xsl:value-of select="Platz"/>
          </TD>
          <TD STYLE="background-color:#FFF5F5">
            <xsl:value-of select="Name"/>
          </TD>
          <TD STYLE="background-color:#FFF5F5">
            <xsl:value-of select="Weltmeister"/>
          </TD>
          <TD STYLE="background-color:#FFF5F5">
            <xsl:value-of select="Geld"/>
          </TD>
          <TD STYLE="background-color:#FFF5F5">
            <xsl:value-of select="Punkte"/>
          </TD>
        </tr>
      </xsl:otherwise>
      </xsl:choose>
    </xsl:for-each>
    </table>
        </td>
          <td width="400" align="right">
            <img src="http://upload.wikimedia.org/wikipedia/de/thumb/2/21/2010_FIFA_World_Cup_logo.svg/260px-2010_FIFA_World_Cup_logo.svg.png" alt="WM 2010"></img>
          </td>
      </tr>
    </table>
      <p></p>
  <table width="1450" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <th colspan="29">
        <h2>Absolvierte Spiele</h2>
      </th>
    </tr>
    <tr bgcolor="#FF9933">
      <th width="80" rowspan="2">Gruppe</th>
      <th width="250" rowspan="2">Begegnung</th>
      <th width="80" rowspan="2">Ergebnis</th>
      <th width="80" colspan="2">HonZ</th>
      <th width="80" colspan="2">Viet</th>
      <th width="80" colspan="2">Seri</th>
      <th width="80" colspan="2">Peuta S</th>
      <th width="80" colspan="2">David</th>
      <th width="80" colspan="2">Peuta W</th>
      <th width="80" colspan="2">Eppi</th>
      <th width="80" colspan="2">Bris</th>
      <th width="80" colspan="2">Eugen</th>
      <th width="80" colspan="2">Oleg</th>
      <th width="80" colspan="2">Klax</th>
      <th width="80" colspan="2">Willy</th>
      <th width="80" colspan="2">Artus</th>
    </tr>
      <tr bgcolor="#FF9933">
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
        <th width="60">Tipp</th>
        <th width="20">P</th>
    </tr>
    <xsl:for-each select="Spiele/Spiel">
      <xsl:sort select="@ID" order="ascending" data-type="number"/>
      <xsl:if test="Spiel_Ende = 'x'">
          <tr STYLE="background-color:#CCFFFF; text-align:center">
        <TD>
          <xsl:value-of select="Gruppe"/>
        </TD>
        <TD>
          <xsl:value-of select="H"/>-<xsl:value-of select="A"/>
        </TD>
        <TD>
          <xsl:value-of select="H_Tore"/>-<xsl:value-of select="A_Tore"/>
        </TD>
        <TD STYLE="background-color:#00FFFF; text-align:center">
          <xsl:value-of select="HonZ_H"/>-<xsl:value-of select="HonZ_A"/>
        </TD>
            <xsl:if test="HonZ_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="HonZ_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="HonZ_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="HonZ_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="HonZ_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="HonZ_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#99CCFF">
          <xsl:value-of select="Viet_H"/>-<xsl:value-of select="Viet_A"/>
        </TD>
            <xsl:if test="Viet_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Viet_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Viet_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Viet_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Viet_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Viet_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#FFCC99">
          <xsl:value-of select="Seri_H"/>-<xsl:value-of select="Seri_A"/>
        </TD>
            <xsl:if test="Seri_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Seri_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Seri_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Seri_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Seri_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Seri_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#CCCCFF">
          <xsl:value-of select="Peuta_S_H"/>-<xsl:value-of select="Peuta_S_A"/>
        </TD>
            <xsl:if test="Peuta_S_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Peuta_S_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Peuta_S_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Peuta_S_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Peuta_S_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Peuta_S_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#FFFFCC">
          <xsl:value-of select="David_H"/>-<xsl:value-of select="David_A"/>
        </TD>
            <xsl:if test="David_P = '0'">
            <TD STYLE="background-color:yellow">
              <xsl:value-of select="David_P"/>
            </TD>
            </xsl:if>
            <xsl:if test="David_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="David_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="David_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="David_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#C0C0C0">
          <xsl:value-of select="Peuta_W_H"/>-<xsl:value-of select="Peuta_W_A"/>
        </TD>
            <xsl:if test="Peuta_W_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Peuta_W_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Peuta_W_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Peuta_W_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Peuta_W_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Peuta_W_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:lightgreen">
          <xsl:value-of select="Eppi_H"/>-<xsl:value-of select="Eppi_A"/>
        </TD>
            <xsl:if test="Eppi_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Eppi_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Eppi_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Eppi_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Eppi_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Eppi_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#CCFFCC">
          <xsl:value-of select="Bris_H"/>-<xsl:value-of select="Bris_A"/>
        </TD>
            <xsl:if test="Bris_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Bris_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Bris_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Bris_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Bris_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Bris_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#FFDEAD">
          <xsl:value-of select="Eugen_H"/>-<xsl:value-of select="Eugen_A"/>
        </TD>
            <xsl:if test="Eugen_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Eugen_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Eugen_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Eugen_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Eugen_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Eugen_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:lightblue">
          <xsl:value-of select="Oleg_H"/>-<xsl:value-of select="Oleg_A"/>
        </TD>
            <xsl:if test="Oleg_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Oleg_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Oleg_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Oleg_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Oleg_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Oleg_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#CCFFFF">
          <xsl:value-of select="Klax_H"/>-<xsl:value-of select="Klax_A"/>
        </TD>
            <xsl:if test="Klax_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Klax_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Klax_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Klax_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Klax_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Klax_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:#CCCCFF">
          <xsl:value-of select="Willy_H"/>-<xsl:value-of select="Willy_A"/>
        </TD>
            <xsl:if test="Willy_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Willy_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Willy_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Willy_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Willy_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Willy_P"/>
              </TD>
            </xsl:if>
        <TD STYLE="background-color:lightyellow">
          <xsl:value-of select="Artus_H"/>-<xsl:value-of select="Artus_A"/>
        </TD>
            <xsl:if test="Artus_P = '0'">
              <TD STYLE="background-color:yellow">
                <xsl:value-of select="Artus_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Artus_P = '1'">
              <TD STYLE="background-color:green; color:white ">
                <xsl:value-of select="Artus_P"/>
              </TD>
            </xsl:if>
            <xsl:if test="Artus_P = '3'">
              <TD STYLE="background-color:red; color:white ">
                <xsl:value-of select="Artus_P"/>
              </TD>
            </xsl:if>
      </tr>
      </xsl:if>
    </xsl:for-each>
  </table>
      <p></p>
  <table width="1370" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <th colspan="15">
        <h2>Die nächsten Spiele</h2>
      </th>
    </tr>
    <tr bgcolor="#FF9933">
      <th width="80" rowspan="2">Gruppe</th>
      <th width="250" rowspan="2">Begegnung</th>
      <th width="80">HonZ</th>
      <th width="80">Viet</th>
      <th width="80">Seri</th>
      <th width="80">Peuta S</th>
      <th width="80">David</th>
      <th width="80">Peuta W</th>
      <th width="80">Eppi</th>
      <th width="80">Bris</th>
      <th width="80">Eugen</th>
      <th width="80">Oleg</th>
      <th width="80">Klax</th>
      <th width="80">Willy</th>
      <th width="80">Artus</th>
    </tr>
    <tr bgcolor="#FF9933">
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
      <th width="80">Tipp</th>
    </tr>
    <xsl:for-each select="Spiele/Spiel">
      <xsl:sort select="@ID" order="ascending" data-type="number"/>
      <xsl:if test="Spiel_Ende != 'x'">
        <tr STYLE="background-color:#CCFFFF; text-align:center">
          <TD>
            <xsl:value-of select="Gruppe"/>
          </TD>
          <TD>
            <xsl:value-of select="H"/>-<xsl:value-of select="A"/>
          </TD>
          <TD STYLE="background-color:#00FFFF; text-align:center">
            <xsl:value-of select="HonZ_H"/>-<xsl:value-of select="HonZ_A"/>
          </TD>
          <TD STYLE="background-color:#99CCFF">
            <xsl:value-of select="Viet_H"/>-<xsl:value-of select="Viet_A"/>
          </TD>
          <TD STYLE="background-color:#FFCC99">
            <xsl:value-of select="Seri_H"/>-<xsl:value-of select="Seri_A"/>
          </TD>
          <TD STYLE="background-color:#CCCCFF">
            <xsl:value-of select="Peuta_S_H"/>-<xsl:value-of select="Peuta_S_A"/>
          </TD>
          <TD STYLE="background-color:#FFFFCC">
            <xsl:value-of select="David_H"/>-<xsl:value-of select="David_A"/>
          </TD>
          <TD STYLE="background-color:#C0C0C0">
            <xsl:value-of select="Peuta_W_H"/>-<xsl:value-of select="Peuta_W_A"/>
          </TD>
          <TD STYLE="background-color:lightgreen">
            <xsl:value-of select="Eppi_H"/>-<xsl:value-of select="Eppi_A"/>
          </TD>
          <TD STYLE="background-color:#CCFFCC">
            <xsl:value-of select="Bris_H"/>-<xsl:value-of select="Bris_A"/>
          </TD>
          <TD STYLE="background-color:#FFDEAD">
            <xsl:value-of select="Eugen_H"/>-<xsl:value-of select="Eugen_A"/>
          </TD>
          <TD STYLE="background-color:lightblue">
            <xsl:value-of select="Oleg_H"/>-<xsl:value-of select="Oleg_A"/>
          </TD>
          <TD STYLE="background-color:#CCFFFF">
            <xsl:value-of select="Klax_H"/>-<xsl:value-of select="Klax_A"/>
          </TD>
          <TD STYLE="background-color:#CCCCFF">
            <xsl:value-of select="Willy_H"/>-<xsl:value-of select="Willy_A"/>
          </TD>
          <TD STYLE="background-color:lightyellow">
            <xsl:value-of select="Artus_H"/>-<xsl:value-of select="Artus_A"/>
          </TD>
        </tr>
      </xsl:if>
    </xsl:for-each>
  </table>
</html>
</xsl:template>
</xsl:stylesheet>
