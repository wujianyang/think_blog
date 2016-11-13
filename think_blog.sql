/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : think_blog

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-13 22:38:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `passwd` varchar(50) CHARACTER SET latin1 NOT NULL,
  `is_freeze` int(1) NOT NULL,
  `last_ip` varchar(20) CHARACTER SET latin1 NOT NULL,
  `last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('4', 'administrator', 'a66abb5684c45962d887564f08346e8d', '0', '0.0.0.0', '2016-11-03 09:57:30');
INSERT INTO `admin` VALUES ('5', 'rootroot', 'e10adc3949ba59abbe56e057f20f883e', '0', '0.0.0.0', '2016-11-03 04:48:31');

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `member_id` int(10) NOT NULL,
  `article_type_id` int(10) NOT NULL,
  `hitnum` int(5) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_ibfk_1` (`member_id`),
  KEY `article_type_id` (`article_type_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`),
  CONSTRAINT `article_ibfk_2` FOREIGN KEY (`article_type_id`) REFERENCES `article_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('3', '如何在网上找到最好的生意', '<p align=\"left\">或许有些人认为新浪播客的关键词排名是遥不可及，或许有些人还在为新浪博客标题也能被收录而迷茫，而今天邹正康来教你把新浪博客标题十天优化到首页，今天我来告诉你，这个真的很简单。</p><p align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;之前我博客的标题还是“蓬舟康取推广巅峰去”，刚刚开通博客时只是觉得这个标题很新颖，十天前我朋友告诉我的新浪博客标题很不合理，我就找了一个百度指数为200左右的关键词，也就是现在的标题，互联网那点事-邹正康新浪播客。今天早上去查看网站时，发现已经在首页。那我先给大家分享一下我是怎么做到的。</p>', '29', '1', '10', '2016-10-14 14:22:28');
INSERT INTO `article` VALUES ('4', '博客根底之深', '<p>\r\n\r\n我上个月写过一篇《教你十天让新浪博客流量破2000》说过我的网站上挂了许多单链，我想应该是我的博客基础打得好吧，百度给了我足够的权重。在这里我也要先谢谢那些愿为我挂单链的朋友，你们的付出造就了这个奇迹。\r\n\r\n<br></p>', '41', '3', '99', '2016-10-14 14:22:31');
INSERT INTO `article` VALUES ('5', '做博客必须要学会坚持', '<p align=\"left\">1）坚持写原创文章</p><p align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;要做好博客，三天打渔两天晒网是不行的，说实话我之前的独立博客也就是没坚持住，最后落入到别人的手里。现在做新浪博客前几天天也是感觉挺新奇的，后来有过放弃，但是由于别人的不断鞭策，现在终于坚持下来了，其中也哭过，笑过，其中有一天写过11篇文章的奇迹。。想体验博客写作的乐趣，与别人分享经验的乐趣，那就坚持博客写作吧。</p><p align=\"left\">&nbsp;&nbsp;&nbsp;（2）坚持投稿</p><p align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;我每天写的博文都会在几个互联网门户网站上投稿，如速途网，A5，搜外等，但是准确的来说，这点我是比较有优势了，因为我都在那几个网站里面开通了专栏，不过只要我们的文章写的好都是有可能上首页的，上首页之后，访问量也是杠杠的。</p><p align=\"left\">&nbsp;&nbsp;&nbsp;（3）坚持发外链</p><p align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其实发外链也是一个非常枯燥的活，比写作和投稿更加无趣。坚持每天发布链，发展的习惯，每天公布的外链，是一个站长需要提高网站PR值，不能忽视的。这往往能吸引蜘蛛爬行通过连锁到您的网站。</p>', '43', '10', '100', '2016-10-14 14:22:39');
INSERT INTO `article` VALUES ('7', '赚足了中国人钱又反华  Scientific Reports', '<p>中国学者们要提高警惕，这无疑是个政治陷阱——他们正在利用手中的权利逼迫追求论文的一些中国学者在政治上就范!呼吁广大中国学者共同抵制这个杂志的政治化倾向！不仅如此，这个杂志的灌水行为也十分明显，口碑越来越差，正在重蹈PLoS ONE的覆辙……!</p><p>&nbsp;&nbsp;大家或许记忆犹新，有些商人或艺人一面大赚大陆的钱财，一面疯狂地反华，反对一个统一的中国，妄图实现分裂中国的阴谋……！呼吁有良知的中国科学家，坚决抵制某些西方杂志的这种学术性政治阴谋！</p><p>无数革命先烈为了祖国的统一献出了宝贵的生命……无数军人正在付出青春和汗水，保家卫国，为祖国的统一前赴后继。我等知识分子切莫为了蝇头小利而出卖自己的灵魂或祖国的尊严……是金子放在什么杂志上都会闪光！学术界也成了反华势力撕裂中国的战场，该因我们的科研评价体系的重大缺陷，即只重视期刊华丽的外表，而歧视对研究内容本身的具体评价。123</p><p><br></p><p><br></p>', '41', '3', '0', '2016-09-14 03:13:59');
INSERT INTO `article` VALUES ('8', '哀悼:39岁青千赵永芳离去，剖析青千压力', '<p>今天早晨，朋友圈被“哀悼：中科院39岁“青年千人”不幸离世”刷屏。看了赵永芳老师的事情，甚是心疼，一位年轻的科技新星就这用陨落了。在报道中，赵永芳老师的去世是非常突然的，可能是由于劳累引起的心脏停止。在微博中，看到赵老师曾说：“再不回去，我就失去回国作贡献的机会了”。看到这一点，同样是年轻人，同样想回国发展，突然之间想写点文字以示悼念。</p><p>赵永芳老师的简历如下：1999年本科毕业于武汉大学，2004在生物物理所获得博士学位，2006年赴美国哥伦比亚大学从事博士后研究，2013年入选中组部国家“青年千人计划”并正式成为生物物理所的PI（课题组组长）。2015年赵老师还获得国家自然科学基金优秀青年科学基金资助。赵老师在学术上成果丰富，她曾以第一作者身份发表了两篇Nature和一篇Nat Chem Bio文章。</p>', '42', '4', '11', '2016-10-18 16:38:27');
INSERT INTO `article` VALUES ('9', '新鲜出炉：2016年国家自然科学基金项目大数据分析', '<p><br></p><p>由表可见，一方面，国家正加大力度提升较不发达地区科研机构完成项目的能力和动力，因此增加了地区科学基金项目的数量；另一方面，国家对青年科学项目的水平和要求已经提高。结合历史数据，基金总项数和基金总金额依然呈正相关。地区科研基金项目多分布在甘肃、广西、贵州、广西、云南等地区，其原因来自制度保护；其他种类基金都分布在高等院校和科研单位比较多的地区，比如北京、上海、广东等经济较发达的城市。</p><p><img src=\"http://image.sciencenet.cn/album/201608/20/1248477dbib4efgu1dipdi.jpg\" class=\"fr-fin\"></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;图1&nbsp;&nbsp;省市项目金额分配（单位：万元）</p><p>2016年的国家自然科学基金项目评审结果已经出炉。科学网在已有结果的基础上，结合历史数据，对基金在不同空间尺度的分布情况进行全面考察，多角度探索科学基金分布特征。</p><p><br></p><p>（一）按项目类别统计2015-2016年项目数量变化趋势</p><p>根据国家自然科学基金委8月17日通告显示，共接收项目申请172843项，经初步审查受理169832项，决定资助其中的37409项，约占总数的22%。和2015年相比，增加202项。</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 表1 &nbsp;2015-2016年资助项目数量变化表</p><table>\r\n  <tbody>\r\n    <tr>\r\n      <td valign=\"top\" width=\"271\">\r\n        <p>项目类型</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"122\">\r\n        <p>项目数（项）</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"126\">\r\n        <p>趋势（项）</p>\r\n      </td>\r\n    </tr>\r\n\r\n    <tr>\r\n      <td valign=\"top\" width=\"271\">\r\n        <p>面上项目</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"122\">\r\n        <p>16934</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"126\">\r\n        <p>↑225</p>\r\n      </td>\r\n    </tr>\r\n\r\n    <tr>\r\n      <td valign=\"top\" width=\"271\">\r\n        <p>重点项目</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"122\">\r\n        <p>612</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"126\">\r\n        <p>↓12</p>\r\n      </td>\r\n    </tr>\r\n\r\n    <tr>\r\n      <td valign=\"top\" width=\"271\">\r\n        <p>创新研究群体项目</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"122\">\r\n        <p>38</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"126\">\r\n        <p>-</p>\r\n      </td>\r\n    </tr>\r\n\r\n    <tr>\r\n      <td valign=\"top\" width=\"271\">\r\n        <p>优秀青年科学基金项目</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"122\">\r\n        <p>400</p>\r\n      </td>\r\n\r\n      <td valign=\"top\" width=\"126\">\r\n        <p>-</p>\r\n      </td>\r\n    </tr>\r\n\r\n    <tr>\r\n      <td valign=\"top\" width=\"271\">\r\n     ', '29', '1', '99', '2016-10-14 14:24:27');
INSERT INTO `article` VALUES ('10', '别扯了！他是把全世界骗了100多年的“大骗子”？', '<p>\r\n\r\n&nbsp;梅契尼柯夫是俄国著名科学家，1908年的诺贝尔奖获得者之一，因其在免疫系统方面开创性的研究享誉世界。主要有三方面成就：1，胚胎学研究，为进化学说提供了证据；2，系统地论述了白细胞吞噬微生物的现象，提出噬菌细胞免疫学说（Phagory-tentheorie）借此与Paul Ehrlich同获1908诺贝尔医学与生理学奖；3，进行了人肠道菌群的研究，认为衰老是肠道菌产毒影响健康，减少肠道菌的毒可以健康长寿，为了抑制肠道菌的增殖，他建议人们喝含有乳杆菌的酸奶。\r\n\r\n<br></p>', '29', '1', '0', '2016-09-14 03:20:18');
INSERT INTO `article` VALUES ('12', '“论文大神”董鹏真是可惜了', '<p>\r\n\r\n今天看到的这个报道还是蛮有意思的：“论文大神”5年发表800篇文章。报道称，2011年起，这位叫董鹏的人，在一些行业报刊和学报学刊发表约800篇文章，大多数为论文。这些文章涵盖现代物流、产业经济学、美学理论、古代文学、心理学、电影戏剧等诸多领域，可谓“论文大神”。 他还伪造各种高大上的身份，虚构、篡改国家级科研项目，再弄上一些显赫的论文合作者，还一稿多投。有意思的是，他还接受了记者的采访，承认自己的抄袭行并道歉。他坦承自己没上过大学，更无博士学历，诸多合作者也是他乱写上去的。\r\n\r\n<br></p>', '29', '1', '0', '2016-09-14 03:21:11');
INSERT INTO `article` VALUES ('14', '自发讣告1113', '&lt;p&gt;李荫远&amp;nbsp;&amp;nbsp;&amp;nbsp;1919年公历6月23日生于成都。&amp;nbsp;1943年在西南联合大学物理系毕业，曾留校任助教。&amp;nbsp;1947年赴美国游学，在獲得博士學位后因美方禁令不克歸國。直至1956年初始得啟程回京，同年4月到中国科学院物理研究所參加工作。&amp;nbsp;1980年当选为中国科学院学部委员。&amp;nbsp;70岁后逐渐退出科研工作和學報编辑等任務，晚年以文史自娱。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;2016&amp;nbsp;年8月22日辞世。本人不愿有遗体告别之类的事，死后不换新衣，不入殡仪馆，由太平间直运火化场所。骨灰由大女保存，日后扬弃入海。&lt;/p&gt;', '29', '25', '0', '2016-11-13 17:05:44');
INSERT INTO `article` VALUES ('15', '一流+二流+三流=几流 ？', '<p>985、211工程尚未结束，很多高校就又吹起了向双一流高校迈进的冲锋号。新学期刚一开学，很多高校就开始付诸行动了：绩效考核标准提升、评聘分离试点、教学方式改革、研究导师淘汰制度改革，各项措施此起彼伏，令人目不暇接。说句实在话，也许是待在学校太久了，身患审丑疲劳症的缘故，对这些改革自己总是懒得搭理：都是些针对普通教师的单边政策，都是些只触及皮毛、换汤不换药的东西，不值得浪费生命去关注。</p><p>&nbsp; &nbsp;科学网有关双一流建设的博文已经很多，对这些博文本人很少评论。问题的关键在于，如果单就世界一流的产出而言，在权力通吃的行政化管理体制不发生根本触动、绩效考核大棒约束下师资精神面貌不发生根本改变前提下，我们国家具备建设双一流高校的条件吗？</p>', '29', '1', '30', '2016-10-14 14:22:50');
INSERT INTO `article` VALUES ('16', '雇员制还是雇工制：取消编制后的高校管理体制预测', '<p>2016年，一则高等院校和公立医院取消编制的消息搅动了神州大地知识分子本就浮躁的心。对于这一重大举措，知识阶层是仁者见仁，智者见智，但较少见到较为理性的对未来走向的预测与理性分析。作为一所普通院校的一线教师，在此就班门弄斧，谈一点个人的意见，欢迎科学网各位专家补充。</p><p>一、高等院校教职员工的身份构成分析</p><p>&nbsp; &nbsp;目前的高等院校教职员工实际上采用的是五类不同人群构成的混合管理体制：引进的杰出人才、非升即走人员、终身雇佣老职工、编制外聘用人员、企业工人身份的员工。院士、杰青、江河湖海人员属于第一类人员，其特点是数量极少，但待遇高、保障好，属于终身制高薪人员。近年引进的海归身份的普通教学科研人员属于第二类，待遇高，压力大，稳定性差，属于合同聘用制人员，人数呈不断增加趋势。扩招以前的教职员工，属于待遇低、保障较好的铁饭碗人员，这部分人的比例最大。编制外聘用人员，身份更为复杂，又分为校聘、院聘、项目聘多种形式，数量不少，在有的院校高达数百人，多在辅导员、教学管理、行政管理岗工作，其特点是稳定性较好、但待遇低、保障水平低。至于高等院校中企业工人身份的员工，则是计划经济、高校办社会的产物，多在学校后勤、产业部门工作，人数通常不多，并且呈迅速减少趋势。</p>', '29', '1', '35', '2016-10-14 14:22:57');
INSERT INTO `article` VALUES ('17', '中国人迫切需要自救自赎', '&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 20px; white-space: normal; word-break: break-all; word-wrap: break-word; text-align: justify; color: rgb(85, 85, 85); letter-spacing: 0.01rem; font-weight: normal; line-height: 1.5; font-family: &amp;quot;Microsoft YaHei&amp;quot;; font-style: normal; font-variant: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span data-fr-verified=&quot;true&quot; style=&quot;font-size: 13px;&quot;&gt;中国人的救赎跟基督徒的救赎不一样，基督徒的救赎前提是原罪，每个人都通过自己艰苦的努力劳作，不避艰险的行善，无私无畏的奉献精神，以期赎换自己的原罪，从而得救，死后升入天堂，要救的是灵魂，目的在于来世，因其人人救赎也就人人得利，因自利而利他，因利人而利世，社会得以和谐共生。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 20px; white-space: normal; word-break: break-all; word-wrap: break-word; text-align: justify; color: rgb(85, 85, 85); letter-spacing: 0.01rem; font-weight: normal; line-height: 1.5; font-family: &amp;quot;Microsoft YaHei&amp;quot;; font-style: normal; font-variant: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span data-fr-verified=&quot;true&quot; style=&quot;font-size: 13px;&quot;&gt;中国人的救赎不一样，强调的是救而不是赎，要救的就是现实的苦难，是现实生活和肉体。如果说有赎的话，那就是要认识到自救是无力的，只有我为人人才能人人为我，从而建立一种互惠互利精神，实现济世救人，社会和谐共生。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 20px; white-space: normal; word-break: break-all; word-wrap: break-word; text-align: justify; color: rgb(85, 85, 85); letter-spacing: 0.01rem; font-weight: normal; line-height: 1.5; font-family: &amp;quot;Microsoft YaHei&amp;quot;; font-style: normal; font-variant: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span data-fr-verified=&quot;true&quot; style=&quot;font-size: 1', '43', '10', '0', '2016-09-27 02:26:21');
INSERT INTO `article` VALUES ('18', '张雪忠：鲁迅、柏杨和龙应台等人的国民性批判错在哪里？', '&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 20px; white-space: normal; word-break: break-all; word-wrap: break-word; text-align: justify; color: rgb(85, 85, 85); letter-spacing: 0.01rem; font-weight: normal; font-size: 2rem; line-height: 1.5; font-family: Arial, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, &amp;quot;Microsoft Yahei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;WenQuanYi Micro Hei&amp;quot;, sans-serif; font-style: normal; font-variant: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;&gt;文/张雪忠&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 20px; white-space: normal; word-break: break-all; word-wrap: break-word; text-align: justify; color: rgb(85, 85, 85); letter-spacing: 0.01rem; font-weight: normal; font-size: 2rem; line-height: 1.5; font-family: Arial, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, &amp;quot;Microsoft Yahei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;WenQuanYi Micro Hei&amp;quot;, sans-serif; font-style: normal; font-variant: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;&gt;来源：思辨的突围&lt;/p&gt;&lt;figure&gt;&lt;img src=&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfsAAALoCAIAAADwQ8stAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAgAElEQVR4nOy9WZMcx3U9nln71stsmBmABEhKoihSliVbcshPDkfYD374hb+bP4S/iBWy/lZYokSYxMIFOzAYzNZr7fV/OF13bmdVNwbAbADyPJCN6uqqrOzpc2+evIusqkpoaGhoaLwHMC56ABoaGhoa5wQL//uP//gPIURVVUVRuK47nU7LsnQcZzQaVVWVpmmSJGEYuq5bFEWSJGmaOo4zmUwmk0lVVVLK7e1t27YtyzIMoyiKOI6jKPrnf/7nq1evGoYhhJDzwKeWjAwnLD/nfYCeB0JVVcv/bOjdl07XKV5KQ+OtQKfTEcT40+lUCFFVlWEYQRB0u93Dw8M8z23bxgl4K0mS4XCY5/nKyorjOHmeTyYT27Y9z/N9vyzLJEkMwzAMw3GcKIo8z5NSlmVJFA/2F/qHpKGhoXHumDG+67r0wvO8NE3TNLVt27ZtwzDgEAkh0jS1LEsIkSRJWZZpmpZl6bpuFEVpmhq', '43', '10', '0', '2016-09-27 02:29:45');
INSERT INTO `article` VALUES ('21', '轻量级jQuery文本编辑器插件Froala WYSIWYG Editor', '&lt;p&gt;\r\n\r\n&lt;img src=&quot;http://assets.jq22.com/plugin/pc-b6895d1a-5931-11e4-b94c-00163e001348.png&quot; alt=&quot;轻量级jQuery文本编辑器插件Froala WYSIWYG Editor&quot; class=&quot;fr-fin&quot;&gt;\r\n\r\n&lt;br&gt;&lt;/p&gt;', '42', '4', '24', '2016-10-14 14:23:04');
INSERT INTO `article` VALUES ('22', '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试', '&lt;p&gt;\r\n\r\n&lt;img src=&quot;http://assets.jq22.com/plugin/pc-b6895d1a-5931-11e4-b94c-00163e001348.png&quot; alt=&quot;轻量级jQuery文本编辑器插件Froala WYSIWYG Editor&quot; class=&quot;fr-fin&quot;&gt;\r\n\r\n&lt;br&gt;&lt;/p&gt;', '42', '4', '33', '2016-10-18 16:38:30');
INSERT INTO `article` VALUES ('25', '测试测试测试789', '&lt;p&gt;\r\n\r\n&lt;img src=&quot;http://assets.jq22.com/plugin/pc-b6895d1a-5931-11e4-b94c-00163e001348.png&quot; alt=&quot;轻量级jQuery文本编辑器插件Froala WYSIWYG Editor&quot; class=&quot;fr-fin&quot;&gt;\r\n\r\n&lt;br&gt;&lt;/p&gt;', '29', '1', '0', '2016-09-27 03:48:04');
INSERT INTO `article` VALUES ('26', '优雅，是一种岁月', '优雅，是一种岁月，它是历经生命种种而呈现出的一种淡若不惊，褪去了少时的稚嫩，而呈现出的一种成熟的韵味。一个优雅的人，一定有着独特的魅力，和饱满的，恬淡而丰盈的灵魂。生活多了一份阳光，少了一些阴霾，懂得了一步一个脚印的踏实和安稳。在简单的外表下，少了浮华，多了一份厚重。一个优雅的人，定是一个大气而宽容的人，在这个浮躁的社会中，如一抹清风，让人心旷神怡，因为心中有山水，在何时何地，都会呈现出清秀的容颜，优雅而迷人的风采。', '29', '1', '0', '2016-10-18 10:55:26');
INSERT INTO `article` VALUES ('29', '桂雨临门', '忽一夜的，八月，桂馥满园，本是香息不醉人的季节，花事廖少，一点素香，穿过水榭楼台，惊醒一枕秋色江南，雕花窗下，小巷柳岸，庭院围墙，簇拥点点金黄，香气扑鼻。\r\n　　\r\n　　采几缕清香沏一壶茶，不觉吟到唐、刘禹锡的一句诗“影近画梁迎晓日，香随绿酒入金杯。”香是香了，醉也是醉了，只是绿酒以茶代之。\r\n　　\r\n　　桂花，亦叫天香，相对桂花之名，我更喜称其为天香，多了几分灵气，仿若一位姿色平平的素衣女子，幽静而溢满清淡的韵味，靠近，让人舒适放松。', '29', '1', '0', '2016-10-18 10:57:47');
INSERT INTO `article` VALUES ('31', '泪点相思，平生不断流水情', '我与庭中月相逐，夜里半盏烛，你正花前月下佳人赋，芙蓉帐中美人骨；我与江中舟独渡，愁绪满幽谷，你正玉树临风四回顾，花言巧语戏鹦鹉；我与南飞鸿相孤，落影画凄楚，你正风流倜傥莺燕舞，千杯醉饮诗无数。\r\n　　\r\n　　念那时，春色绵绵，细雨霏霏。烟波千里，楼阁花语。现如今，秋深落落，寒风瑟瑟。满眼疮痍，荒芜人间。眼望着这萧索的秋光，却只是徒增伤怀而已。在这个寒意逼人的秋日，或许酒才是唯一的慰藉与温暖吧。', '29', '1', '0', '2016-10-18 10:58:30');
INSERT INTO `article` VALUES ('32', '一城烟火人生', '生活本来就是平淡中，添加的五味杂陈，苦涩中的甜蜜，负累中的喜悦，矛盾复杂中，道不清，说不明的烟火人生。无止境，贪念里的矛盾生活，得到了，又不珍惜；失去了，又眷恋；飞高了，还期盼那山高；美好了，还想再多些曼妙；人心无休止的念，驾驭在生活上，各钟滋味，在心。', '29', '1', '0', '2016-10-18 10:59:19');
INSERT INTO `article` VALUES ('33', '相遇秋思浅 ，落花静流年', '有一种遇见，莫过于最美的落花。有一种执着，莫过于将年华的青春。情愿放在卑微的角落，将自己的忧伤。选择深深的掩盖，使自己变得坚强。不再悲伤难过，不再受到伤害。人生的每一次相遇，都是那么可遇而不可求，彼此的深记。都是那么无意中，却成了彼此。最美的花开，红尘花开红尘落。执惜执着执落花，古往今来。多少千古绝唱，多少千古执着。多少守候千年。最后一路走来，却是情深缘浅。缘散此去离别浅，花月残落流年美。\r\n　　\r\n　　相遇秋思浅，落花静流年。一切看淡的与一切走远的，终只是与自己。一道路过而已，途中的落花。途中的欢笑，途中的冷暖。待时光过后，都是一道无言的美。生命在于懂得，在于遇见。只有懂得才是遇见的美，只有懂得才能遇见更好的流年。或更好的自己，走在每一段岁月的时光中。我们都要经历一段人生的开始，也要经历一段人生的落幕。当命运站在这场，无言的世界中。当所有的相遇从你身边，漫漫离开你时。当所有的珍惜，换不回一场在意时。我们要做的便是，不再打扰。进不去的世界，我们要做的便是。微笑的祝福，每一个从我们身边擦肩的路人', '29', '1', '0', '2016-10-18 10:59:38');
INSERT INTO `article` VALUES ('34', '爱情的思念不公', '我相信爱情很近，很近，走的受伤是因为希望的祝福，我看见泪流的每一次伤感，都会感动内心的最后真挚。\r\n　　\r\n　　不是每个人都会相信爱情，不是每个人都追逐梦想，我把自己的相信保持在等你的泪流，梦中的醒来，你看不见我最后的撕心裂肺，我也看不见你来生的擦肩而过。\r\n　　\r\n　　我不是别人说的那样，你不是掩饰的那样吗？我欣赏你的唯美的笑容，我喜欢你那动听的思念，可是你的祝福给了别人，我的等待为了你。\r\n　　\r\n　　走在思念的城市，我喜欢的总是找不到，我等待的总是不会来，爱你的心总是容易受伤，等你的真总是无法入梦。\r\n　　\r\n　　思念是一种频率，相思是一种泪水，说不出爱意，喊不出的味道，你看见的每一次表达，我说出的每一个风景，都是不能再见的可能。', '29', '1', '0', '2016-10-18 11:00:23');
INSERT INTO `article` VALUES ('35', '懂得了，才更容易获得快乐！', '你曾相信命中注定的缘吗？你曾相信命中注定的伤害与分离吗？你曾相信命中注定的祝福跟惦记吗？当我们无法用言语来解释在自己身上发生的事实时，都会用那个词来解释，一切都是“命中注定”的。或许吧，真的有命中注定的结局。\r\n　　\r\n　　常常会看到“为爱藏心”的心情，常常看到“如果今生你负了我，那必定是前生我伤了你”可是真的有前世的恩怨吗？因为伤到极点，痛到极点，就会想用一些东西来扶平自己的伤口，就会想到“命中注定的结局””前生今世轮回的结果”可是有谁认真的想过，今生的自己又是犯下了怎么样的错误，是否还需要来生再还今生的债。', '29', '1', '0', '2016-10-18 11:19:44');
INSERT INTO `article` VALUES ('37', '一首离殇曲，万千惆怅泪！', '三月里的春天，傍晚云雾笼罩，鸟儿陆续归巢，在昏暗烛光的映衬下，野草显得格外茂盛。\r\n　　\r\n　　漫步在河边的小道上，微风拂面，柳絮纷飞，恍惚间似乎看到了我那远在千里之外的故乡，不知曾经的那个青梅竹马的她是否还在等着我归来。\r\n　　\r\n　　桥上人来人往，恋人成双成对，如今我身心疲惫，夜再漫长，也无心欣赏桥边的红芍药。\r\n　　\r\n　　湖面上波光荡漾，倒映在湖中的月影随着湖水摇摇晃晃，正当彷徨时，从湖中心的渔船里传来了一曲离别而又伤感的笛声。\r\n　　\r\n　　回忆决堤，随风飘回多年以前，那时的我为了考取功名，寒窗苦读，终日不会梳理头发，夜里凿通邻居家的墙壁，只为了能借光多看会书。', '29', '1', '0', '2016-10-18 11:20:09');
INSERT INTO `article` VALUES ('38', '愿我们最终都能嫁给爱情~', '身边有很多的亲戚、朋友都结婚了，一部分因为有了孩子，不得不结婚；一部分因为家里的原因，随便凑合着过；还一部分因为看上对方的票子、车子或者是房子；只有为数一丢丢的人是因为爱情才选择结婚的。\r\n　　\r\n　　而我，是一个矛盾的集合体，任何事对家人都是报喜不报忧，我不想他们担心自己的女儿在外过的不好。\r\n　　\r\n　　辞职了，我想着等找到工作再说，遇到困难了，我想着等熬过去再说，所以对家人，任何事在我的嘴里都是风轻云淡、轻描淡写的一句带过~', '29', '1', '0', '2016-10-18 11:20:27');
INSERT INTO `article` VALUES ('39', '如果时光倒退，我愿意', '我不相信爱情，或许是因为看的多了的缘故，身边的朋友交女朋友，总是没多久就分了。我不知道什么是爱情，但我认为爱情是美好的，圣洁的，我们应该真诚的对待爱情，而不是把爱情当儿戏。\r\n　　\r\n　　朋友的对待爱情的方式，让我以为我已经看透了爱情，直到遇到了她。\r\n　　\r\n　　我和她第一次见面是在食堂，一到放学，学校食堂总是人满为患，一个女孩在我前面打着汤，一不留心就被人群挤到，她\r\n　　\r\n　　手一抖，汤汁便洒到了我的洁白的衬衫上，女孩慌慌张张的拿出纸来擦，发现擦不掉后，不停的向我道歉，虽然有些怒，但也无奈，倒也没为难她。', '29', '1', '0', '2016-10-18 11:20:52');

-- ----------------------------
-- Table structure for article_comment
-- ----------------------------
DROP TABLE IF EXISTS `article_comment`;
CREATE TABLE `article_comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `comment_content` varchar(1000) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `article_comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  CONSTRAINT `article_comment_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_comment
-- ----------------------------
INSERT INTO `article_comment` VALUES ('1', '3', '29', '我讲的很多东西，以及我的过去做的一些事情，肯定很多人看了会骂我。寒门再难出贵子，我不是富二代，不是官二代，我要吃喝，我只能靠自己。', '2016-10-08 15:01:37');
INSERT INTO `article_comment` VALUES ('2', '3', '41', '再后来，我又被招商加盟骗了5000块，然后我就做招商加盟，也搞了点钱。', '2016-10-08 15:03:01');
INSERT INTO `article_comment` VALUES ('3', '3', '41', '这3个项目，算是我的第一桶金，带骗的色彩，当时也年轻，天不怕地不怕。就像赌博一样，输了钱，就想赚回来；别人把我的钱骗走了，我就去复制他的广告和模式也这样做。', '2016-10-08 15:03:15');
INSERT INTO `article_comment` VALUES ('7', '3', '43', '招商加盟之后，我又开始操作擦边项目，比如增大增粗，透视的，电视X什么的。为什么我不喜欢做正规项目，这个跟我的阅读方向有关。', '2016-10-08 15:04:18');
INSERT INTO `article_comment` VALUES ('8', '3', '46', '如果一个人什么样的杂书都喜欢看，那他什么类型的项目都容易上手。很多大师说聚焦聚焦，我感觉没必要聚焦。', '2016-10-08 15:07:38');
INSERT INTO `article_comment` VALUES ('9', '3', '50', '在网络摸爬滚打很多年了，这么多年来，始终坚持，有迷茫，也有梦想照进现实，起起伏伏，人生一路狂奔，到底能走多久？', '2016-10-08 15:08:00');
INSERT INTO `article_comment` VALUES ('10', '3', '53', '我没有答案，我常说我是一个没有明天的人，大部分时间我都很寂寞，寂寞的夜显得尤其漫长', '2016-10-08 15:08:24');
INSERT INTO `article_comment` VALUES ('11', '3', '59', '每每夜深人静，我喜欢把寂寞和痛苦稀释在文字里，不求喝彩，只为宣泄。', '2016-10-08 15:08:43');
INSERT INTO `article_comment` VALUES ('12', '3', '54', '&lt;p&gt;一篇不错的文章！！！&lt;/p&gt;', '2016-10-20 14:59:55');
INSERT INTO `article_comment` VALUES ('13', '3', '64', '把这些从脑袋里搬到网上，很多词语不知道会不会被屏蔽，随缘吧！', '2016-10-08 15:10:42');
INSERT INTO `article_comment` VALUES ('16', '4', '29', '大家都说师傅领进门,修行在个人', '2016-10-13 16:02:16');
INSERT INTO `article_comment` VALUES ('17', '4', '41', '在网络摸爬滚打很多年了，这么多年来，始终坚持，有迷茫，也有梦想照进现实，起起伏伏，人生一路狂奔，到底能走多久？', '2016-10-13 16:02:34');
INSERT INTO `article_comment` VALUES ('18', '9', '47', '很多大师说聚焦聚焦，我感觉没必要聚焦。', '2016-10-13 16:04:13');
INSERT INTO `article_comment` VALUES ('19', '10', '44', '这个跟我的阅读方向有关。', '2016-10-13 16:06:50');
INSERT INTO `article_comment` VALUES ('23', '3', '29', '&lt;p&gt;一篇不错的文章！！！&lt;/p&gt;', '2016-10-20 02:31:25');
INSERT INTO `article_comment` VALUES ('24', '15', '29', '&lt;p&gt;很现实&lt;/p&gt;', '2016-10-20 04:28:43');

-- ----------------------------
-- Table structure for article_type
-- ----------------------------
DROP TABLE IF EXISTS `article_type`;
CREATE TABLE `article_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_type_name` varchar(100) NOT NULL,
  `member_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_type
-- ----------------------------
INSERT INTO `article_type` VALUES ('1', '生活日志', '29');
INSERT INTO `article_type` VALUES ('3', '工作内容', '41');
INSERT INTO `article_type` VALUES ('4', '技术帖子', '42');
INSERT INTO `article_type` VALUES ('10', '工作相关', '43');
INSERT INTO `article_type` VALUES ('12', '后端技术', '41');
INSERT INTO `article_type` VALUES ('13', 'Linux', '41');
INSERT INTO `article_type` VALUES ('14', '中秋佳节', '41');
INSERT INTO `article_type` VALUES ('15', '国庆七天乐', '45');
INSERT INTO `article_type` VALUES ('16', '中秋博饼', '64');
INSERT INTO `article_type` VALUES ('17', '博饼状元', '47');
INSERT INTO `article_type` VALUES ('23', '平常琐事', '42');
INSERT INTO `article_type` VALUES ('24', '奋斗故事', '41');
INSERT INTO `article_type` VALUES ('25', '后端技术', '29');
INSERT INTO `article_type` VALUES ('30', '测试分类一1113', '29');

-- ----------------------------
-- Table structure for complaint
-- ----------------------------
DROP TABLE IF EXISTS `complaint`;
CREATE TABLE `complaint` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `complain_content` varchar(255) NOT NULL,
  `admin_id` int(10) DEFAULT NULL,
  `complain_time` datetime NOT NULL,
  `isPass` int(11) NOT NULL,
  `pass_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of complaint
-- ----------------------------
INSERT INTO `complaint` VALUES ('2', '41', '申请激活账号', null, '0000-00-00 00:00:00', '0', null);
INSERT INTO `complaint` VALUES ('6', '83', '请求激活', '4', '2016-11-13 05:34:32', '1', '2016-11-13 05:43:00');

-- ----------------------------
-- Table structure for friends
-- ----------------------------
DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `fans_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `fans_id` (`fans_id`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`),
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`fans_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friends
-- ----------------------------
INSERT INTO `friends` VALUES ('1', '29', '41');
INSERT INTO `friends` VALUES ('2', '29', '42');
INSERT INTO `friends` VALUES ('3', '29', '45');
INSERT INTO `friends` VALUES ('4', '41', '29');
INSERT INTO `friends` VALUES ('5', '41', '43');
INSERT INTO `friends` VALUES ('6', '41', '47');
INSERT INTO `friends` VALUES ('7', '29', '46');
INSERT INTO `friends` VALUES ('8', '29', '58');
INSERT INTO `friends` VALUES ('9', '42', '41');
INSERT INTO `friends` VALUES ('10', '50', '41');
INSERT INTO `friends` VALUES ('11', '50', '29');
INSERT INTO `friends` VALUES ('12', '41', '44');
INSERT INTO `friends` VALUES ('13', '43', '41');
INSERT INTO `friends` VALUES ('14', '44', '41');
INSERT INTO `friends` VALUES ('15', '45', '41');
INSERT INTO `friends` VALUES ('16', '46', '41');
INSERT INTO `friends` VALUES ('17', '53', '41');
INSERT INTO `friends` VALUES ('18', '57', '41');
INSERT INTO `friends` VALUES ('20', '58', '41');
INSERT INTO `friends` VALUES ('21', '64', '41');
INSERT INTO `friends` VALUES ('22', '72', '41');
INSERT INTO `friends` VALUES ('23', '44', '41');
INSERT INTO `friends` VALUES ('24', '29', '41');
INSERT INTO `friends` VALUES ('25', '43', '41');
INSERT INTO `friends` VALUES ('27', '44', '41');
INSERT INTO `friends` VALUES ('28', '46', '41');
INSERT INTO `friends` VALUES ('29', '48', '41');
INSERT INTO `friends` VALUES ('30', '50', '41');
INSERT INTO `friends` VALUES ('31', '48', '41');
INSERT INTO `friends` VALUES ('32', '45', '41');
INSERT INTO `friends` VALUES ('47', '45', '29');
INSERT INTO `friends` VALUES ('48', '48', '29');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `sex` int(1) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `head_pic` varchar(200) NOT NULL,
  `head_pic_save_path` varchar(200) DEFAULT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hitnum` int(5) NOT NULL,
  `is_freeze` int(1) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `last_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('29', 'username2', '8cef992a5af6b216dd3c62ae39f4a13b', '0', '123456@qq.com', '12312341234', 'address road street', 'head_pic/head_pic_1478662502.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_1472190183.png', 'question one', 'answer one', '10', '0', '0.0.0.0', '2016-11-09 11:35:02');
INSERT INTO `member` VALUES ('41', 'username3', '8cef992a5af6b216dd3c62ae39f4a13b', '0', '323456@qq.com', '12333333333', 'address road street', 'head_pic/head_pic_1472536722.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_1472536722.png', 'question 3', 'answer an3', '0', '0', '::1', '2016-08-30 07:58:42');
INSERT INTO `member` VALUES ('42', 'username4', '8cef992a5af6b216dd3c62ae39f4a13b', '0', '333333@qq.com', '12333333333', 'address road street', 'head_pic/head_pic_1475044747.png', 'D:/wamp/www/think_blog/Upload/head_pic/head_pic_1475044747.png', 'question one3', 'answer one3', '0', '1', '::1', '2016-09-28 02:39:07');
INSERT INTO `member` VALUES ('43', 'username5', '8cef992a5af6b216dd3c62ae39f4a13b', '1', '123456@qq.com', '12355555555', 'address road street', 'head_pic/head_pic_1473413259.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '1', '127.0.0.1', '2016-09-25 10:28:42');
INSERT INTO `member` VALUES ('44', 'username6', '8cef992a5af6b216dd3c62ae39f4a13b', '0', '123456@qq.com', '12366666666', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '1', '::1', '2016-09-23 05:46:25');
INSERT INTO `member` VALUES ('45', 'username7', '8cef992a5af6b216dd3c62ae39f4a13b', '1', '123456@qq.com', '12377777777', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-23 10:38:26');
INSERT INTO `member` VALUES ('46', 'username8', '8cef992a5af6b216dd3c', '1', '123456@qq.com', '12388888888', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-23 10:38:36');
INSERT INTO `member` VALUES ('47', 'username9', '8cef992a5af6b216dd3c', '1', '123456@qq.com', '12399999999', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '0', '::1', '2016-09-30 05:32:01');
INSERT INTO `member` VALUES ('48', 'username10', '8cef992a5af6b216dd3c', '1', '123456@qq.com', '12300000000', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-23 10:38:53');
INSERT INTO `member` VALUES ('50', 'username13', '8cef992a5af6b216dd3c', '0', '131313@qq.com', '13333333333', 'address road street', 'head_pic/head_pic_1472782788.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one3', '0', '0', '::1', '2016-09-02 04:19:48');
INSERT INTO `member` VALUES ('53', 'username16', '8cef992a5af6b216dd3c', '1', '161616@qq.com', '16612311341', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-23 11:52:39');
INSERT INTO `member` VALUES ('54', 'username17', '8cef992a5af6b216dd3c', '1', '123456@qq.com', '12312341234', 'address road street', 'head_pic/head_pic_default.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_default.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-23 11:56:57');
INSERT INTO `member` VALUES ('57', 'username20', '8cef992a5af6b216dd3c', '1', '123456@qq.com', '12312341234', 'address road street', 'head_pic/head_pic_1472092495.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_1472092495.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-25 04:34:55');
INSERT INTO `member` VALUES ('58', 'username21', '8cef992a5af6b216dd3c', '1', '123654@qq.com', '12345678945', 'address road street', 'head_pic/head_pic_1472092803.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_1472092803.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-25 04:40:03');
INSERT INTO `member` VALUES ('59', 'username22', '8cef992a5af6b216dd3c', '1', '456789@qq.com', '12312121212', 'address road street', 'head_pic/head_pic_1472109387.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_1472109387.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-25 09:16:27');
INSERT INTO `member` VALUES ('64', 'username24', '8cef992a5af6b216dd3c', '1', '123456@qq.com', '12312341234', 'address road street', 'head_pic/head_pic_1472112432.png', 'D:\\wamp\\www\\blog\\images/head_pic/head_pic_1472112432.png', 'question one', 'answer one', '0', '0', '::1', '2016-08-25 10:07:12');
INSERT INTO `member` VALUES ('72', 'USERNAME28', 'e10adc3949ba59abbe56', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1474620306.png', 'D:/wamp/www/think_blog/Upload/head_pic/head_pic_1474620306.png', 'question', 'answer', '0', '0', '::1', '2016-09-23 04:45:06');
INSERT INTO `member` VALUES ('73', 'username123', 'e10adc3949ba59abbe56e057f20f883e', '0', '123456@qq.com', '12312341234', 'address roads', 'head_pic/head_pic_1476337850.png', null, 'question one', 'answer one', '0', '0', '::1', '2016-10-13 01:50:50');
INSERT INTO `member` VALUES ('74', 'username111', 'e35cf7b66449df565f93c607d5a81d09', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1476169921.png', null, 'question', 'answer', '0', '0', '::1', '2016-10-11 03:12:01');
INSERT INTO `member` VALUES ('76', 'username112', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1476170192.png', null, 'question one', 'answer one', '0', '0', '::1', '2016-10-11 03:16:32');
INSERT INTO `member` VALUES ('77', 'username113', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1476170267.png', null, 'question', 'answer', '0', '0', '::1', '2016-10-11 03:17:47');
INSERT INTO `member` VALUES ('78', 'username114', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1476170333.png', null, 'question', 'answer', '0', '0', '::1', '2016-10-11 03:18:53');
INSERT INTO `member` VALUES ('80', 'username333', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/', null, 'question one', 'answer one', '0', '0', '0.0.0.0', '2016-11-09 10:53:03');
INSERT INTO `member` VALUES ('81', 'username331', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/', null, 'question one', 'answer one', '0', '0', '0.0.0.0', '2016-11-09 10:58:04');
INSERT INTO `member` VALUES ('82', 'username332', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1478660441.png', null, 'question one', 'answer one', '0', '0', '0.0.0.0', '2016-11-09 11:00:41');
INSERT INTO `member` VALUES ('83', 'username335', 'e10adc3949ba59abbe56e057f20f883e', '1', '123456@qq.com', '12312341234', 'address road', 'head_pic/head_pic_1478660899.png', null, 'question one1', 'answer one', '0', '1', '0.0.0.0', '2016-11-09 11:08:19');

-- ----------------------------
-- Table structure for mess
-- ----------------------------
DROP TABLE IF EXISTS `mess`;
CREATE TABLE `mess` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `messer_id` int(10) NOT NULL,
  `content` varchar(200) NOT NULL,
  `messed_id` int(10) NOT NULL,
  `mess_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `messer_id` (`messer_id`),
  KEY `messed_id` (`messed_id`),
  CONSTRAINT `mess_ibfk_1` FOREIGN KEY (`messer_id`) REFERENCES `member` (`id`),
  CONSTRAINT `mess_ibfk_2` FOREIGN KEY (`messed_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mess
-- ----------------------------
INSERT INTO `mess` VALUES ('1', '41', '温馨的留言洋溢着幸福的期待，美好的回味是凝聚着不褪的色彩，快乐的心情只因你的存在，深情的牵挂传递着不变的情怀。 在你的温馨空间留下我的足迹，把真诚留在你的', '29', '2016-10-14 10:47:51');
INSERT INTO `mess` VALUES ('2', '42', '寄一份真情的问候，字字句句都是幸福快乐；送一串深深的祝福，分分秒秒都是平安吉祥；传一份浓浓的心意，点点滴滴都是万事如意；祝朋友：幸福安康!', '29', '2016-10-14 10:48:18');
INSERT INTO `mess` VALUES ('3', '41', '把愉快的心情带给你,把美好的幸福分给你,把甜蜜的日子寄给你,把衷心的祝福送给你。轻轻地一声祝福,祝朋友幸福、快乐! 生命的美丽,好似一朵鲜花,每天的心情,像是一幅油画,生活的笑容,那是彩色的云霞,朋友的温馨,是我永远的牵挂,祝福你一生：让笑永驻,让友情永存,让美好永恒!', '29', '2016-10-14 10:49:05');
INSERT INTO `mess` VALUES ('4', '45', '博客里有你的足迹我很满足', '29', '2016-10-14 10:49:35');
INSERT INTO `mess` VALUES ('5', '47', '朋友中有你的名字我很骄傲', '29', '2016-10-14 10:49:55');
INSERT INTO `mess` VALUES ('6', '54', '看到你的留言我很感动', '29', '2016-10-14 10:50:21');
INSERT INTO `mess` VALUES ('7', '29', '感谢生活，感谢生命，感谢你', '41', '2016-10-14 10:50:39');
INSERT INTO `mess` VALUES ('8', '43', '有你做我的朋友，我会无比珍惜!', '41', '2016-10-14 10:51:04');
INSERT INTO `mess` VALUES ('9', '58', '你的每一份关怀都如阳光般温暖', '41', '2016-10-14 10:51:29');
INSERT INTO `mess` VALUES ('14', '44', '字字句句都是幸福快乐', '29', '2016-10-19 16:45:32');
INSERT INTO `mess` VALUES ('16', '45', '送一串深深的祝福，分分秒秒都是平安吉祥', '29', '2016-10-19 16:46:08');
INSERT INTO `mess` VALUES ('17', '29', '&lt;p&gt;进来留言&lt;/p&gt;', '41', '2016-10-20 03:47:18');
INSERT INTO `mess` VALUES ('18', '29', '&lt;p&gt;又来留言&lt;/p&gt;', '41', '2016-10-20 03:48:14');
INSERT INTO `mess` VALUES ('19', '29', '&lt;p&gt;双来留言&lt;/p&gt;', '41', '2016-10-20 03:49:02');
INSERT INTO `mess` VALUES ('20', '29', '&lt;p&gt;留言&lt;/p&gt;', '41', '2016-10-20 04:21:44');

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `photo_title` varchar(100) NOT NULL,
  `member_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of photo
-- ----------------------------
INSERT INTO `photo` VALUES ('1', '无与伦比', '29');
INSERT INTO `photo` VALUES ('3', '笑颜如花', '41');
INSERT INTO `photo` VALUES ('4', '幸福不过', '41');
INSERT INTO `photo` VALUES ('5', '一分安定', '43');
INSERT INTO `photo` VALUES ('6', '不了了之', '44');
INSERT INTO `photo` VALUES ('7', '若即那回忆', '45');
INSERT INTO `photo` VALUES ('8', '倒述丶年华', '43');
INSERT INTO `photo` VALUES ('9', 'ヽ 殤年', '46');
INSERT INTO `photo` VALUES ('10', '暮然回首', '45');
INSERT INTO `photo` VALUES ('13', '涂鸦、心情', '46');
INSERT INTO `photo` VALUES ('14', '青春记忆', '41');
INSERT INTO `photo` VALUES ('15', '楼市崩塌', '48');
INSERT INTO `photo` VALUES ('22', '个人生活', '29');
INSERT INTO `photo` VALUES ('23', '日常生活', '29');

-- ----------------------------
-- Table structure for photo_img
-- ----------------------------
DROP TABLE IF EXISTS `photo_img`;
CREATE TABLE `photo_img` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `photo_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `img_title` varchar(100) NOT NULL,
  `img_src` varchar(500) NOT NULL,
  `img_path` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`),
  CONSTRAINT `photo_img_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of photo_img
-- ----------------------------
INSERT INTO `photo_img` VALUES ('2', '1', '29', '无与伦比二1113', 'photo_img/photo_img_1479042371.gif', null);
INSERT INTO `photo_img` VALUES ('3', '3', '41', '颜笑如花一', 'photo_img/photo_img_1475119005.png', null);
INSERT INTO `photo_img` VALUES ('4', '1', '29', '无与伦比一', 'photo_img/photo_img_1475129202.png', null);
INSERT INTO `photo_img` VALUES ('5', '3', '41', '颜笑如花二', 'photo_img/photo_img_1475129274.png', null);
INSERT INTO `photo_img` VALUES ('6', '4', '41', '幸福。。。', 'photo_img/photo_img_1475131189.png', null);
INSERT INTO `photo_img` VALUES ('7', '1', '29', '无与伦比san', 'photo_img/photo_img_1475131849.png', null);
INSERT INTO `photo_img` VALUES ('8', '8', '43', '青春年华一', 'photo_img/photo_img_1475131998.png', null);
INSERT INTO `photo_img` VALUES ('12', '6', '44', '了了了了三', 'photo_img/photo_img_1475132090.png', null);
INSERT INTO `photo_img` VALUES ('20', '1', '29', '测试相片二', 'photo_img/photo_img_1477620967.png', null);
INSERT INTO `photo_img` VALUES ('21', '1', '29', '测试相片一', 'photo_img/photo_img_1477624210.png', null);
INSERT INTO `photo_img` VALUES ('30', '1', '29', '测试测试', 'photo_img/photo_img_1478661547.png', null);
INSERT INTO `photo_img` VALUES ('31', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('33', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('34', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('35', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('36', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('37', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('38', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('39', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('40', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('41', '1', '29', '测试相片一', '', null);
INSERT INTO `photo_img` VALUES ('42', '1', '29', '测试相片一', 'photo_img/photo_img_1479030873.gif', null);
