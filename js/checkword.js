// JavaScript Document
 function LTrim(str)
{
	if (str==null){return null;}
	for(var i=0;str.charAt(i)==" ";i++);
	return str.substring(i,str.length);
}
								
function RTrim(str)
{
	if (str==null){return null; }
	for(var i=str.length-1;str.charAt(i)==" ";i--);
	return str.substring(0,i+1);
}
function Trim(str){return LTrim(RTrim(str));}
function emailCheck (emailStr) 
{
										var checkTLD=1;
										var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
										var emailPat=/^(.+)@(.+)$/;
										var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
										var validChars="\[^\\s" + specialChars + "\]";
										var quotedUser="(\"[^\"]*\")";
										var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
										var atom=validChars + '+';
										var word="(" + atom + "|" + quotedUser + ")";
										var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
										var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
										var matchArray=emailStr.match(emailPat);
										if (matchArray==null) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										}
										var user=matchArray[1];
										var domain=matchArray[2];
										for (i=0; i<user.length; i++) {
										if (user.charCodeAt(i)>127) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										   }
										}
										for (i=0; i<domain.length; i++) {
										if (domain.charCodeAt(i)>127) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										   }
										}
										if (user.match(userPat)==null) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										}
										var IPArray=domain.match(ipDomainPat);
										if (IPArray!=null) {
										for (var i=1;i<=4;i++) {
										if (IPArray[i]>255) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										   }
										}
										return true;
										}
										var atomPat=new RegExp("^" + atom + "$");
										var domArr=domain.split(".");
										var len=domArr.length;
										for (i=0;i<len;i++) {
										if (domArr[i].search(atomPat)==-1) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										   }
										}
										if (checkTLD && domArr[domArr.length-1].length!=2 && 
										domArr[domArr.length-1].search(knownDomsPat)==-1) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										}
										if (len<2) {
										//alert("อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมล์");
										return false;
										}
										return true;
							}