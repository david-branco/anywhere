<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="2.0">
    
    <xsl:template match="/">
        <html>
            <head>
                <title>
                    <xsl:value-of select="sip/meta/title"/>
                </title>
            </head>
            <body>
                <center>
                    <h1> <xsl:value-of select="sip/meta/title"/> </h1>
                        <xsl:if test="sip/meta/subtitle">
                            <h2> <xsl:value-of select="sip/meta/subtitle"/> </h2>
                        </xsl:if>
                    <hr width="80%"/>

               <!-- Metadata -->
               <xsl:apply-templates select="sip/meta"/>
                </center>     
                <!-- Abstract -->
                <xsl:apply-templates select="sip/abstract"/>

                <!-- Delivarebles-->
                <xsl:apply-templates select="sip/deliverables"/>
                
                <!-- Files -->
                <xsl:apply-templates select="sip/files"/>
                
            </body>
        </html>
    </xsl:template>
    
    <xsl:template match="meta">
        <table>
            <tr>
                <td>
                    <b>keyname</b>:
                    <xsl:value-of select="keyname"/>
                    <br/>
                    <b>course</b>:
                    <xsl:value-of select="course"/>   
                    <br/>
                    <b>classe</b>:
                    <xsl:value-of select="classe"/> 
                </td>
                <td>
                    <b>sdate</b>:
                    <xsl:value-of select="sdate"/>
                    <xsl:if test="edate">
                        <br/>
                        <b>edate</b>:
                        <xsl:value-of select="edate"/>      
                    </xsl:if>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <xsl:apply-templates select="workteam"/>
                </td>
                <td width="50%">
                    <xsl:apply-templates select="supervisors"/>
                </td>
            </tr>
        </table>
    
    </xsl:template>    
    
    <xsl:template match= "member">
        <tr>
            <td width="70%">
                <xsl:value-of select="name"/>
                <br/>
                <xsl:value-of select="id"/>
                <br/>
                <a href="mailto:{email}"/>
                <xsl:value-of select="email"/>                 
                <xsl:if test="webpage">
                    <br/>
                    <a href="{webpage}">
                        <xsl:value-of select="webpage"/>
                    </a>
                </xsl:if>
            </td>
            <td width="30%">
                <xsl:if test="photo">
                    <img src="{photo}" style="max-width:80px;max-height:100px;"/>
                </xsl:if>
            </td>
        </tr>
    </xsl:template>
    
    <xsl:template match="workteam">
        <table>
           <xsl:apply-templates/>
        </table>
    </xsl:template>
    
    
    <xsl:template match="supervisors">
        <ul>
            <xsl:apply-templates/>
        </ul>
    </xsl:template>
    
    <xsl:template match="supervisor">
        <li>
            <xsl:value-of select="name"/>
            <a href="{email}">
                <xsl:value-of select="email"/>
            </a>
            <xsl:if test="webpage">
                <br/>
                <a href="{webpage}">
                    <xsl:value-of select="webpage"/>
                </a>
            </xsl:if>
        </li>
    </xsl:template>
     
     <xsl:template match="p">
         <p>
             <xsl:apply-templates/>
         </p>
     </xsl:template>
    
    <xsl:template match="b">
        <b>
            <xsl:apply-templates/>
        </b>
    </xsl:template>
    
    <xsl:template match="i">
        <i>
            <xsl:apply-templates/>
        </i>
    </xsl:template>
    
    <xsl:template match="u">
        <u>
            <xsl:apply-templates/>
        </u>
    </xsl:template>
    
    <xsl:template match="xref">
        <a href="{@uri}">
            <xsl:value-of select="."/>
        </a>
    </xsl:template>
    
    <xsl:template match="acr">
        <abbr title="{desc}">
            <xsl:value-of select="abv"/>
        </abbr>
    </xsl:template>
    
    <xsl:template match="files">
        <td>
            <h3>Files</h3>
            <ul>
                <xsl:apply-templates/>
            </ul>           
        </td> 
    </xsl:template>
    
    <xsl:template match="file">
        <li>
            <b>Link: </b><a href="{@path}"><xsl:value-of select="@path"/></a>
            <xsl:if test="@format"><b> Format: </b><xsl:value-of select="@format"/></xsl:if>
            <xsl:if test="@checksum"><b> Checksum: </b><xsl:value-of select="@checksum"/></xsl:if>
            <xsl:if test="."><b> Description: </b><xsl:value-of select="."/></xsl:if>
        </li>
    </xsl:template>
    
</xsl:stylesheet>