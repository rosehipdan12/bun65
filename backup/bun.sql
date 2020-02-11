/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : bun

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 11/02/2020 08:50:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `UserID` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UnionMember` int(11) NOT NULL,
  `Admin` int(11) NOT NULL,
  `LastUpdate` datetime(0) NOT NULL,
  `Password` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`UserID`) USING BTREE,
  UNIQUE INDEX `UserID_UNIQUE`(`UserID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '利用者マスタ' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('lyduong', 'Ly Duong', 1, 1, '0000-00-00 00:00:00', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `m_user` VALUES ('notadmin', 'Ly Duong', 0, 0, '0000-00-00 00:00:00', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for t_entryinfo
-- ----------------------------
DROP TABLE IF EXISTS `t_entryinfo`;
CREATE TABLE `t_entryinfo`  (
  `E_ROWID` int(5) NOT NULL AUTO_INCREMENT COMMENT '�����̔�',
  `E_INS_DATE` date NOT NULL COMMENT '��i���e��',
  `E_DIV_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '��i���e�Ҏx����',
  `E_USR_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '��i���e�Җ�',
  `E_USR_NAME_F` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `E_USR_MEMBER_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `E_PAR_KBN` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `E_AGE_KBN` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `E_BM_CODE` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '����',
  `E_KBN_CODE` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�敪',
  `E_FILE_PATH` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�t�@�C���p�X��',
  `E_THUMBNAIL` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `E_FILE_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�t�@�C����',
  `E_TANKA_INFO` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�Z�̍�i',
  `E_TITLE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '��i�^�C�g��',
  `E_COMMENT` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '��i�R�����g',
  `E_SIZE_L` decimal(10, 2) NOT NULL COMMENT '��i�T�C�Y_�c',
  `E_SIZE_B` decimal(10, 2) NOT NULL COMMENT '��i�T�C�Y_��',
  `E_SIZE_W` decimal(10, 2) NOT NULL COMMENT '��i�T�C�Y_��',
  `E_WEIGHT` double NULL DEFAULT NULL,
  `E_R_ZIPCODE` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�ԑ���_�X�֔ԍ�',
  `E_R_Addr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�ԑ���_�Z��',
  `E_R_TEL` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `E_R_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '�ԑ���_���O',
  `E_INV_FLG` tinyint(1) NOT NULL COMMENT '�����t���O',
  PRIMARY KEY (`E_ROWID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3748 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '��i�e�[�u��' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_entryinfo
-- ----------------------------
INSERT INTO `t_entryinfo` VALUES (3438, '2016-06-08', '沼津支部', '中村主水', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03438.jpeg', '', '', 'これはテストデータです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3439, '2016-06-08', '沼津支部', '中村主水', NULL, NULL, NULL, NULL, 'B03', 'RA', '', NULL, '', 'ゆび輪より まわしが似合う スウィートテン', '', 'これはテストデータです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3440, '2016-06-08', 'Ｒ＆Ｄ支部', '小野寺桂子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03440.jpeg', '', 'にゃんこ', 'かわいい我が家のペットです。', 30.00, 40.00, 0.00, NULL, '', '', '', '小野寺桂子', 1);
INSERT INTO `t_entryinfo` VALUES (3441, '2016-06-08', 'Ｒ＆Ｄ支部', '小野寺桂子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03441.jpeg', '', '', 'おいしいふかひれ', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3442, '2016-06-08', 'Ｒ＆Ｄ支部', '佐藤　恵美子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03442.jpeg', '', 'チューリップ', '心休まるお花です', 30.00, 10.00, 0.00, NULL, '211-0051', '', '044-733-4101', '佐藤　恵美子', 1);
INSERT INTO `t_entryinfo` VALUES (3443, '2016-06-08', 'Ｒ＆Ｄ支部', '佐藤恵美子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03443.jpeg', '', '', '我が家の庭に咲いたお花です', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3444, '2016-06-09', 'Ｒ＆Ｄ支部', '宇田　正男', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '被災地の絆は強し　櫻咲く\r\n', '', '被災地の皆さんが一日も早く日常生活に戻れることを祈念して。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3445, '2016-06-09', 'Ｒ＆Ｄ支部', '山崎　浩', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '寄せ鍋を囲む家族の 絆かな\r\n', '', '帰省した子等と寄鍋の夕餉となる。そんな家族の日常。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3446, '2016-06-09', 'Ｒ＆Ｄ支部', '若月　貢', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '除染済み 戻る家族に風光る\r\n', '', '一瞬の放射能汚染から除染が進み、規制解除となって絆を取り戻す我が家に帰る家族に光を見ました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3447, '2016-06-09', 'Ｒ＆Ｄ支部', '小出　信雄', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '福島の悲劇を思ふ　弥生かな\r\n', '', '震災から５年、先の見えない福島の皆さんのご心労、ご心痛を思うと身につまされて…', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3448, '2016-06-09', 'Ｒ＆Ｄ支部', '小林　道子', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '春集ふ　楽しき絆職の友\r\n', '', '若い時から３０年余り、職場の人達と逢って年一度食事会を楽しんでいます。\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3449, '2016-06-09', 'Ｒ＆Ｄ支部', '神田　威', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '卒業式　歌う絆の「花は咲く」\r\n', '', '「花は咲く」は、東日本大震災後、多くの人に歌われ、多くの人の絆となった。まさに「縁(えん)成(じょう)」の歌である。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3450, '2016-06-09', 'Ｒ＆Ｄ支部', '青木　茂子', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '復興を絆で明日へ 黄水仙\r\n', '', '東日本震災から５年、今日までの報道に接し、互いに思い遣る心、絆の深さが復興に役立つと…', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3451, '2016-06-09', 'Ｒ＆Ｄ支部', '増田　のり子', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '北よりの　絆に乗りて春だより\r\n', '', '未曽有の災害に一人一人が絆を深めて一日も早く復興の足音が確かなものになることを祈って…', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3452, '2016-06-09', 'Ｒ＆Ｄ支部', '竹内　澄英', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '春浅し 友と絆の食事会\r\n', '', '友と食事したことを絆の句にしました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3453, '2016-06-09', 'Ｒ＆Ｄ支部', '長崎　友男', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '紅梅の絆深めて　枝に並ぶ\r\n', '', '枝に並んで健気に咲く紅梅に被災地の絆と頑張りを感じた。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3454, '2016-06-09', 'Ｒ＆Ｄ支部', '渡邊　友子', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '春彼岸 絆深める家族かな\r\n', '', '人とのつながり薄れる中、まずは家族のつながり大切に。\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3455, '2016-06-09', 'Ｒ＆Ｄ支部', '北村　秀男', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '被災地に思いを寄せて ３．１１忌\r\n', '', '５年目の被災地の皆様のご苦労に思いを寄せて詠いました。\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3456, '2016-06-09', 'Ｒ＆Ｄ支部', '櫻井　敏夫', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '御柱　今といにしえ絆(ほだ)す綱\r\n', '', '故郷にも諏訪神社があり、その昔御柱を曳いたことが走馬灯のよう。祖父母，両親，隣の親父，同級生・・・。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3457, '2016-06-16', 'Ｒ＆Ｄ支部', '井上　由美子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03457.jpeg', '', '', '赤くそびえるポートタワー', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3458, '2016-06-16', 'Ｒ＆Ｄ支部', '亀井　良支子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03458.jpeg', '', '', '相生湾の朝焼け', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3459, '2016-06-16', 'Ｒ＆Ｄ支部', '江原　恭一', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03459.jpeg', '', '', '私の宝ラジコンくん', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3460, '2016-06-16', 'Ｒ＆Ｄ支部', '高田　彩花', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03460.jpeg', '', '', '香るアーモンド', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3461, '2016-06-16', 'Ｒ＆Ｄ支部', '高田　将吾', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03461.jpeg', '', '', '水辺で輝く！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3462, '2016-06-16', 'Ｒ＆Ｄ支部', '高田　直幸', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03462.jpeg', '', '', '絢爛豪華　白鷲城', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3463, '2016-06-09', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3464, '2016-06-09', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3465, '2016-06-16', 'Ｒ＆Ｄ支部', '山長　歩', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03465.jpeg', '', '', '飛びます！飛びます！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3466, '2016-06-16', 'Ｒ＆Ｄ支部', '西陰地　朗', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03466.jpeg', '', '', 'もうかりまっか？！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3467, '2016-06-09', 'Ｒ＆Ｄ支部', '千枝　比呂樹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3468, '2016-06-09', 'Ｒ＆Ｄ支部', '千枝　比呂樹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3469, '2016-06-16', 'Ｒ＆Ｄ支部', '大石　和彦', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03469.jpeg', '', '', 'うおんたな！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3470, '2016-06-16', 'Ｒ＆Ｄ支部', '竹口　由美子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03470.jpeg', '', '', '平和', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3471, '2016-06-16', 'Ｒ＆Ｄ支部', '竹内　愛香', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03471.jpeg', '', '', '命', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3472, '2016-06-16', 'Ｒ＆Ｄ支部', '竹内　元紀', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03472.jpeg', '', '', 'すまいる', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3473, '2016-06-16', 'Ｒ＆Ｄ支部', '竹内　順哉', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03473.jpeg', '', '', '明石はやっぱり・・・', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3474, '2016-06-16', 'Ｒ＆Ｄ支部', '竹内　美月', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03474.jpeg', '', '', '友達', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3475, '2016-06-16', 'Ｒ＆Ｄ支部', '竹内　陽亮', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03475.jpeg', '', '', '賑わいの我が職場', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3476, '2016-06-16', 'Ｒ＆Ｄ支部', '本間　裕章', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03476.jpeg', '', '', 'のほほんのひと時', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3477, '2016-06-16', 'Ｒ＆Ｄ支部', '本城　准一', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03477.jpeg', '', '', '行ってみたい世界旅行', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3478, '2016-06-16', 'Ｒ＆Ｄ支部', '本城　友子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03478.jpeg', '', '', '車でドライブ', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3479, '2016-06-09', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3480, '2016-06-09', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3481, '2016-06-09', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3482, '2016-06-09', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3483, '2016-06-09', 'Ｒ＆Ｄ支部', '千枝　比呂樹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3484, '2016-06-09', 'Ｒ＆Ｄ支部', '千枝　比呂樹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3485, '2016-06-09', 'Ｒ＆Ｄ支部', '千枝', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3486, '2016-06-09', 'Ｒ＆Ｄ支部', '千枝', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3487, '2016-06-09', 'Ｒ＆Ｄ支部', '藁科　卓', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03487.jpeg', '', '', '去年、日本科学未来館で行われた『チームラボ　踊る！アート展と、学ぶ！未来の遊園地』の最終日に行った時の写真です。参加者の画像を巨大なスクリーンに映写するもので、私の絵もこの写真の中のどこかにあります。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3488, '2016-06-16', 'Ｒ＆Ｄ支部', '細谷　和子', NULL, NULL, NULL, NULL, 'B05', 'RA', '', NULL, '', 'どうしてる？\r\nスマホでひとこと　聞いてみる。\r\n思いがつながる 心がつながる', '', 'スマホやケータイの電波は見えません。でも、手軽なこの機器で簡単な一言をいうだけで、離れた人とつながっていられます。いつでもどこでも、思い立ったらすぐに、大事な人との接点を。我が社の製品自慢でもあります。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3489, '2016-06-17', 'Ｒ＆Ｄ支部', '吉田 千酉', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03489.jpeg', '', '', '題名：幸せな「あんよ」\r\n\r\n友達が母親に♪ということで、夏休みを使って会いにいってきました。\r\nかわいいあんよが「幸せ」って言ってるみたい！と思ってシャッターを押した１枚です。\r\nこの写真はいつみても自分自身がほんわか幸せな気持ちになる１枚です。\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3490, '2016-06-09', 'Ｒ＆Ｄ支部', '佐藤  俊昭', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03490.jpeg', '', '', 'お正月の寒い日でしたが、息子二人の無邪気な笑顔に、心がほっこり温まる一幕でした。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3491, '2016-06-21', '沼津支部', '内海　弘美', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03491.jpeg', '', 'Flower Party', '庭に咲いた花を真っ白の生地の上に咲かせました。パッチワークです。', 90.00, 90.00, 0.00, NULL, '4120026', '御殿場市東田中589-1', '0550835338', '内海　弘美', 0);
INSERT INTO `t_entryinfo` VALUES (3492, '2016-06-10', '沼津支部', '宮川　イキ', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03492.jpeg', '', '楽しい吊るし雛', '静岡県では吊るし雛を「雛のつるし飾り」といいます。孫の健やかな成長を願って作りました。', 23.00, 23.00, 75.00, NULL, '4110803', '静岡県三島市大場1087-140', '0559732793', '宮川　イキ', 0);
INSERT INTO `t_entryinfo` VALUES (3493, '2016-06-10', 'Ｒ＆Ｄ支部', '相原　帆南', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03493.jpeg', '', '', '家族で紅葉狩りに出かけたとき、撮影しました。\r\n秋空とモミジがきれいだったので。\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3494, '2016-06-10', 'Ｒ＆Ｄ支部', '豊田　学', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03494.jpeg', '', '', 'ローラー式の滑り台から、かっこよくジャンプ！\r\nと思ったら、スカイダイビング！\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3495, '2016-06-10', 'Ｒ＆Ｄ支部', '藁科　卓', NULL, NULL, NULL, NULL, 'B03', 'RA', '', NULL, '', '昔より　時空超えてる　太陽よ', '', '今日も朝起きると、太陽が昇る。古より、時空を超えて我々を見守ってくれた。それに比較すると地球上の出来事のなんと小さなことよ。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3496, '2016-06-10', 'Ｒ＆Ｄ支部', '山元　康裕', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03496.jpeg', '', '夢幻郷', '東北でも屈指の桜名所を見渡せる丘に登り、夜明けを待つ。空が明るくなった頃、丘には霧に包まれ視界を遮る。しかし、太陽が昇り始めると霧が少しずつ明けるどころかピンク色に染まり、満開の桜に彩りを与えた。僅かな時間でしか見られない光景に感銘を受けつつシャッターを切った。', 47.00, 36.00, 3.00, NULL, '230-0001', '横浜市鶴見区矢向1-13-23-408', '045-585-9553', '山元　　康裕', 0);
INSERT INTO `t_entryinfo` VALUES (3497, '2016-06-10', 'Ｒ＆Ｄ支部', '杉本 実咲', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03497.jpeg', '', 'ぼくそうを食べるごま', 'うさぎのひげを書くとき筆で細く書くことをがんばりました。', 29.60, 21.00, 0.00, NULL, '212-0025', '川崎市幸区古川町87-218', '044-544-8582', '杉本　実咲', 0);
INSERT INTO `t_entryinfo` VALUES (3498, '2016-06-10', 'Ｒ＆Ｄ支部', '杉本　千明', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03498.jpeg', '', '花火の中のウサギ', '家で飼っているウサギの特徴の首が茶色いところなどを書けました。', 21.00, 29.60, 0.00, NULL, '212-0025', '川崎市幸区古川町87-218', '044-544-8582', '杉本　千明', 0);
INSERT INTO `t_entryinfo` VALUES (3499, '2016-06-10', 'Ｒ＆Ｄ支部', '鈴木　日奈子', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03499.jpeg', '', 'お父さんの似顔絵', '初めて画用紙に描きました。とても楽しく描けました。', 21.00, 29.70, 0.00, NULL, '211-0053', '川崎市中原区上小田中6-45-1-206', '090-5850-0774', '鈴木　日奈子', 0);
INSERT INTO `t_entryinfo` VALUES (3500, '2016-06-10', 'Ｒ＆Ｄ支部', '渡部　幸子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, '', '', 'ベビー誕生・サンプラー', '6年ぶりの孫のために作成しました。', 37.00, 45.00, 3.00, NULL, '233-0015', '横浜市港南区日限山1-57-19　ランドステージ下永谷駅前二番館203', '045-435-5877', '神戸　祐史', 1);
INSERT INTO `t_entryinfo` VALUES (3501, '2016-06-10', 'Ｒ＆Ｄ支部', '渡部　幸子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, '', '', 'ベビー誕生・サンプラー', '6年ぶりの孫のために作成しました。', 37.00, 45.00, 3.00, NULL, '233-0015', '横浜市港南区日限山1-57-19　ランドステージ下永谷駅前二番館203', '045-435-5877', '神戸　祐史', 1);
INSERT INTO `t_entryinfo` VALUES (3502, '2016-06-10', 'Ｒ＆Ｄ支部', '出町　真喜子', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03502.jpeg', '', '「心意気」', '富士通労組単一組織結成65周年記念の「総合文化展」とのことで、久し振りに筆を持ってみました。\r\n力不足・練習不足の賜物(!?)ですが、皆さんと65周年のお祝いの気持ちを分かち合いたいと思い、参加させていただきます。\r\n条幅紙に大きい文字を書きたいと考え、この三文字を選びました。好きな言葉です。', 35.00, 136.00, 0.00, NULL, '245-0053', '横浜市戸塚区上矢部町14-1　モア・ステージ戸塚501', '045-814-1577', '出町　真喜子', 0);
INSERT INTO `t_entryinfo` VALUES (3503, '2016-06-10', 'Ｒ＆Ｄ支部', '藁科　卓', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03503.jpeg', '', '原宿', '碁が名人に勝ったというニユースが最近あったが、機械的なイメージの中にも人間的な要素があり、色調はポップで原宿を想起させる色合いとした。', 45.00, 45.00, 1.00, NULL, '215-0003', '川崎区麻生区高石2-35-1-501', '050-3642-0807', '藁科　卓', 0);
INSERT INTO `t_entryinfo` VALUES (3504, '2016-06-10', 'Ｒ＆Ｄ支部', '神戸　薫子', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, '', '', 'お父さんの似顔絵', '娘がお父さんの似顔絵を書いてくれました。', 30.00, 21.00, 0.00, NULL, '233-0015', '横浜市港南区日限山1-57-19　ランドステージ下永谷駅前二番館203', '045-435-5877', '神戸　祐史', 1);
INSERT INTO `t_entryinfo` VALUES (3505, '2016-06-10', 'Ｒ＆Ｄ支部', '神戸　薫子', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, '', '', 'お父さんの似顔絵', '娘がお父さんの似顔絵を書いてくれました。', 30.00, 21.00, 0.00, NULL, '233-0015', '横浜市港南区日限山1-57-19　ランドステージ下永谷駅前二番館203', '045-435-5877', '神戸　祐史', 1);
INSERT INTO `t_entryinfo` VALUES (3506, '2016-06-10', 'Ｒ＆Ｄ支部', '玉置　晴之', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03506.jpeg', '', '静寂', '高尾山の登山道で、行きかう人々の賑わいをよそにやわらかな光の中で静かに佇む苔に惹かれました。', 30.50, 25.40, 0.00, NULL, '212-0004', '川崎市幸区小向西町1-1-3　ルセナ102号', '044-555-3787', '玉置　晴之', 0);
INSERT INTO `t_entryinfo` VALUES (3507, '2016-06-10', 'Ｒ＆Ｄ支部', '山上 高豊', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, '', '', '晩秋の空を彩る', '昨年、11月23日に開催された「第110回 長野えびす講煙火大会」で打ち上げられた、ミュージックスターマインの写真です。フィッシュアイレンズを使い、大きく開いた花火と、立ち並ぶ露店の様子をとらえました。', 40.70, 51.30, 2.50, NULL, '380-0802', '長野県長野市上松2丁目20-1', '026-233-1209', '山上 高豊', 1);
INSERT INTO `t_entryinfo` VALUES (3508, '2016-06-10', 'Ｒ＆Ｄ支部', '山上 高豊', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, '', '', '晩秋の空を彩る', '昨年、11月23日に開催された「第110回 長野えびす講煙火大会」で打ち上げられた、ミュージックスターマインの写真です。フィッシュアイレンズを使い、大きく開いた花火と、立ち並ぶ露店の様子をとらえました。', 40.70, 51.30, 2.50, NULL, '380-0802', '長野県長野市上松2丁目20-1', '026-233-1209', '山上 高豊', 1);
INSERT INTO `t_entryinfo` VALUES (3509, '2016-06-13', '沼津支部', '内海　文夫', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03509.jpeg', '', '', '毎年田植えが終わった後の逆さ富士を楽しみにしています。この時期しか見れません。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3510, '2016-06-13', 'Ｒ＆Ｄ支部', '飯野　あゆみ', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03510.jpeg', '', '好雨知時節', '　杜甫の七言律詩「春夜に雨を喜ぶ」の一文。\r\n直訳は「よい（好い）雨は、その降るとき（時節）を心得ている」。\r\n　雨でさえ季節の移り変わりを知っており、それが自然と言うもので、自然に逆らうことなく、身を委ねること、受け入れることも必要である。', 44.50, 30.00, 0.00, NULL, '252-0206', '相模原市中央区淵野辺4-23-7', '042-750-7280', '飯野　博明', 0);
INSERT INTO `t_entryinfo` VALUES (3511, '2016-06-10', 'Ｒ＆Ｄ支部', '吉田千酉', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03511.jpeg', '', 'Dancing of Water', '昨年の秋に、神奈川県南足柄市にある曹洞宗大雄山最乗寺の紅葉を撮りに行った際に撮影した１枚です。\r\nお寺の前にある水の入ったかめを除いたら、お水がダンスしていました♪\r\n', 41.00, 56.00, 2.00, NULL, '252-0233', '相模原市中央区鹿沼台1-8-17-406', '042-751-6458', 'フェスラー　千酉', 0);
INSERT INTO `t_entryinfo` VALUES (3512, '2016-06-10', 'Ｒ＆Ｄ支部', '東　由裕', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03512.jpeg', '', 'ビールジョッキ', '清涼感のある色合いに仕上げてみました。', 11.00, 11.00, 8.00, NULL, '211-0025', '川崎市中原区木月3-4-29　ハイツ二葉201', '044-422-7395', '東　由裕', 0);
INSERT INTO `t_entryinfo` VALUES (3513, '2016-06-10', 'Ｒ＆Ｄ支部', '松本　日出一', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03513.jpeg', '', '切株のペン立てorマグカップ', '初めてにしてはこんなものでしょ！', 10.00, 15.00, 8.00, NULL, '211-8588', '川崎市中原区上小田中4-1-1　富士通(株)川崎工場　', '044-754-2358', 'FCT・ビジ推　松本　日出一', 0);
INSERT INTO `t_entryinfo` VALUES (3514, '2016-06-10', 'Ｒ＆Ｄ支部', '石松　俊一', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03514.jpeg', '', 'ビアジョッキとつまみ皿', 'ビールとつまみを載せる皿を作ってみました。\r\nおそろいの柄で、晩酌を楽しんでいます。', 15.00, 15.00, 15.00, NULL, '213-0025', '川崎市高津区蟹ヶ谷200番地　ヒューマンスクエア日吉ウルビノ1003', '044-755-8449', '石松　俊一', 0);
INSERT INTO `t_entryinfo` VALUES (3515, '2016-06-10', 'Ｒ＆Ｄ支部', '安蔵　真紀', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03515.jpeg', '', '大きめマグカップ・うずまき柄豆皿', '労働組合主催の陶芸教室で作ったものです。\r\nカップは父へのプレゼント用に渋めにしました。\r\n小皿は表と裏の柄違いが気にいっています。', 9.00, 20.00, 10.00, NULL, '211-0012', '川崎市中原区中丸子459-1-706', '090-4718-8074', '安蔵　真紀', 0);
INSERT INTO `t_entryinfo` VALUES (3516, '2016-06-10', 'Ｒ＆Ｄ支部', '相原　房子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03516.jpeg', '', '晩秋のベンチ', '銀杏を見に出かけたとき、老夫婦がベンチで休んでいました。ほのぼのとした雰囲気に思わずシャッターを切るました。', 25.40, 36.50, 0.00, NULL, '190-0031', '立川市砂川町1-19-4', '042-537-6576', '相原　房子', 0);
INSERT INTO `t_entryinfo` VALUES (3517, '2016-06-13', 'Ｒ＆Ｄ支部', '辻村　浩史', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03517.jpeg', '', '', '元気なひまわり畑の中で元気一杯ガッツポーズ！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3518, '2016-06-13', 'Ｒ＆Ｄ支部', '金杉　要之輔', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03518.jpeg', '', '銀杏', '右手が不自由にもかかわらず、ホームにて週2回指導を受けています。味のある”94才”の力作です。', 39.00, 27.00, 0.00, NULL, '223-0065', '横浜市港北区高田東1-35-18', '045-543-4777', '金杉　要之輔', 0);
INSERT INTO `t_entryinfo` VALUES (3519, '2016-06-13', 'Ｒ＆Ｄ支部', '辻本　あかね', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03519.jpeg', '', 'お弁当入れ', '保冷の生地を入れるのが難しかったです。', 22.00, 30.00, 13.00, NULL, '674-0056', '明石市大久保町山手台4-114', '080-5359-2804', '辻本　智美', 0);
INSERT INTO `t_entryinfo` VALUES (3520, '2016-06-13', 'Ｒ＆Ｄ支部', '辻本　みなつ', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03520.jpeg', '', 'エプロン', 'ミシンでまっすぐ縫うのが難しかったです。', 83.00, 55.00, 0.00, NULL, '674-0056', '明石市大久保町山手台4-114', '080-5359-2804', '辻本　智美', 0);
INSERT INTO `t_entryinfo` VALUES (3521, '2016-06-13', 'Ｒ＆Ｄ支部', '渡部　幸子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03521.jpeg', '', 'ベビー誕生・サンプラー', '6年ぶりの孫のために作成しました', 37.00, 45.00, 3.00, NULL, '233-0015', '横浜市港南区日限山1-57-19　ランドステージ下永谷駅前二番館203', '045-435-5877', '神戸　祐史', 0);
INSERT INTO `t_entryinfo` VALUES (3522, '2016-06-13', 'Ｒ＆Ｄ支部', '神戸　薫子', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03522.jpeg', '', 'お父さんの似顔絵', '娘がお父さんの似顔絵を書いてくれました。', 30.00, 21.00, 0.00, NULL, '233-0015', '横浜市港南区日限山1-57-19　ランドステージ下永谷駅前二番館203', '045-435-5877', '神戸　祐史', 0);
INSERT INTO `t_entryinfo` VALUES (3523, '2016-06-13', 'Ｒ＆Ｄ支部', '山上 高豊', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03523.jpeg', '', '晩秋の空を彩る', '昨年、11月23日に開催された「第110回 長野えびす講煙火大会」で打ち上げられた、ミュージックスターマインの写真です。フィッシュアイレンズを使い、大きく開いた花火と、立ち並ぶ露店の様子をとらえました。', 40.70, 51.30, 2.50, NULL, '380-0802', '長野県長野市上松２丁目２０－１', '026-233-1209', '山上 高豊', 0);
INSERT INTO `t_entryinfo` VALUES (3524, '2016-06-16', 'Ｒ＆Ｄ支部', '今田　雅敏', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03524.jpeg', '', '', '本州最北端の宿（竜飛岬）', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3525, '2016-06-16', 'Ｒ＆Ｄ支部', '千枝　比呂樹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03525.jpeg', '', '', '鞆の浦のシンボル”常夜灯”と”竜馬さん”', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3526, '2016-06-13', 'Ｒ＆Ｄ支部', '佐藤　保範', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03526.jpeg', '', '阿　吽　＜道成寺の金剛力士像＞', 'シナベニアに絵を写し、彫刻刀で線を彫り、染料で色づけします。板の木目を生かせる面白さを表現しました。', 50.00, 70.00, 8.00, NULL, '382-0824', '長野県上高井郡高山村緑ヶ丘3305-87', '026-246-4180', '佐藤　保範', 0);
INSERT INTO `t_entryinfo` VALUES (3527, '2016-06-13', 'Ｒ＆Ｄ支部', '木下　正之助', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03527.jpeg', '', '白鷺の憩い', '平成28年2月初旬の早朝、千曲川左岸に位置する長野市川中島八幡原史跡公園にて、四阿の片隅で羽を休める一羽の白鷺（シラサギ）を写真に収めました。', 63.00, 55.00, 3.00, NULL, '380-0802', '長野県長野市上松3-13-22', '026-241-0882', '木下　正之助', 0);
INSERT INTO `t_entryinfo` VALUES (3528, '2016-06-13', '本社支部', '柏木　のりこ', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03528.jpeg', '', 'Vitamin!', '深く腐食させた銅版によるエンボス(空刷り)です。\r\nインクを使わずに、黄色の紙に型押ししています。', 33.00, 33.00, 2.00, NULL, '182-0021', '東京都調布市調布ヶ丘４－１０－３　サンフラット３０２', '080-5458-0600', '柏木 典子', 0);
INSERT INTO `t_entryinfo` VALUES (3529, '2016-06-13', '本社支部', '関根百佑', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03529.jpeg', '', 'おかあさん', '娘から母の日のプレゼントです。\r\nあたたかい気持ちになりました。', 68.00, 17.50, 0.00, NULL, '145-0071', '大田区田園調布1-19-1', '090-1119-1700', '関根奈穂子', 0);
INSERT INTO `t_entryinfo` VALUES (3530, '2016-06-13', 'Ｒ＆Ｄ支部', '似内　誠一', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03530.jpeg', '', '「赤富士と吊るし雲」', '赤富士(夏、雨上がりの日の出)と変わった雲を期待して撮影の10日程前から就寝前に\r\n　・天気図(太平洋に高気圧、能登半島沖に低気圧)\r\n　・インターネットで富士山のライブカメラ\r\nを見ながら検討し深夜出かけて行き日の出に偶然「吊るし雲」に変化しました。\r\n撮影日　2015-9-13(日)5:36', 40.00, 50.00, 4.00, NULL, '183-0033', '東京都府中市万梅町2-54-7', '042-364-6959', '似内　誠一', 0);
INSERT INTO `t_entryinfo` VALUES (3531, '2016-06-13', '本社支部', '北村　茜', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03531.jpeg', '', '臨行書詩巻', 'バランスよく書くのに苦労しました', 163.30, 34.80, 0.00, NULL, '963-8021', '郡山市桜木１丁目５－５', '024-935-0662', '北村　茜', 0);
INSERT INTO `t_entryinfo` VALUES (3532, '2016-06-13', '本社支部', '竹内　智之', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03532.jpeg', '', '帰還', '澄み切った冬の夕刻、低速シャッターで撮影した写真となります。', 25.40, 30.50, 0.00, NULL, '154-0011', '東京都世田谷区上馬２－４－１３', '03-3421-6724', '竹内　智之', 0);
INSERT INTO `t_entryinfo` VALUES (3533, '2016-06-15', '本社支部', '井ノ口　あゆみ', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03533.jpeg', '', 'どこまでも', '果てしなく続く、一面の空と水鏡。\r\nどこまでも行く。', 45.00, 56.00, 0.50, NULL, '170-0003', '東京都豊島区駒込１－４０－１１－１２０３', '090-4174-5423', '井ノ口あゆみ', 0);
INSERT INTO `t_entryinfo` VALUES (3534, '2016-06-15', '本社支部', '手塚　佳彦', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03534.jpeg', '', '親友', '小学校最後のサッカー大会、昼食での一コマ。\r\n何を楽しく話しているんでしょうね。\r\n息子と「親友のイットー」、親友は春から東京の中学へ進学しました。\r\n', 25.40, 30.50, 0.00, NULL, '321-0968', '宇都宮市中今泉2-11-12　ｻｰﾊﾟｽ今泉第二202', '028-636-2630', '手塚　佳彦', 0);
INSERT INTO `t_entryinfo` VALUES (3535, '2016-06-13', '本社支部', '衣笠　理恵', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03535.jpeg', '', '座布団', '母の依頼で作成しました。', 50.00, 50.00, 0.00, NULL, '176-0022', '東京都練馬区向山２丁目１２－２５　グランルーフ２０２', '090-3062-6701', '衣笠　理恵', 0);
INSERT INTO `t_entryinfo` VALUES (3536, '2016-06-13', '本社支部', '島津　恵子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03536.jpeg', '', 'シーサー', 'シーサーは、沖縄県などでみられる伝説の獣の像で、家の門や屋根、村落の高台などに置かれ、災いをもたらす悪霊を追い払う魔除けの意味があると言われています。ネットで画像を検索するといろんなシーサーが表示されますが、自分のイメージするシーサーを色とりどりの軽量樹脂粘土を使って作ってみました。', 15.50, 7.50, 8.50, NULL, '366-0034', '埼玉県深谷市常盤町85-8', '048-572-3041', '島津　恵子', 0);
INSERT INTO `t_entryinfo` VALUES (3537, '2016-06-13', '本社支部', '山岸　明子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03537.jpeg', '', '', '我が家のかわいいミケが元気の源です。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3538, '2016-06-13', '本社支部', '竹内　智之', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03538.jpeg', '', '', '船出～青春の船', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3539, '2016-06-13', '本社支部', '手塚　佳彦', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '負けない！！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3540, '2016-06-14', '本社支部', '手塚　佳彦', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03540.jpeg', '', '', '負けない！！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3541, '2016-06-20', '本社支部', '飯島幹也', NULL, NULL, NULL, NULL, 'B05', 'RA', '', NULL, '', '讃美歌を 心の中で 歌いおり 雨降る病室 眠れぬ夜は', '', '昨年体調を崩して10日ほど入院しました。\r\n慣れない環境や不安で眠れないときは、信仰を持っているため、讃美歌を歌って過しました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3542, '2016-06-13', 'Ｒ＆Ｄ支部', '山本　愛', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03542.jpeg', '', '中国・桂林', '今年96歳になる上司が旅行で撮った写真を僕が描き、久しぶりに歓談しました。', 37.00, 53.00, 0.00, NULL, '651-1112', '兵庫県神戸市北区鈴欄台東町9-10-11', '078-594-7371', '山本　愛', 0);
INSERT INTO `t_entryinfo` VALUES (3543, '2016-06-13', 'Ｒ＆Ｄ支部', '原野　吉郎', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03543.jpeg', '', 'リンコレリオカトレア', '金箔をカトレアの花のピンクと葉の緑のバランス調和をご覧戴ければ幸いです。', 55.00, 67.00, 3.00, NULL, '674-0051', '明石市大久保町大窪2041-36', '078-936-6110', '原野　吉郎', 0);
INSERT INTO `t_entryinfo` VALUES (3544, '2016-06-13', '沼津支部', '内海　勇志', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03544.jpeg', '', '', '散歩に疲れて熟睡中の愛犬「マック」です。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3545, '2016-06-13', 'Ｒ＆Ｄ支部', '小渕　広光', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03545.jpeg', '', 'LOOK　CUP', '本作品は組合陶芸教室で製作したものです。当日時間がなく、作品はあらっぽくなってカップとして使用できる代物ではありません。タイトルは「観賞」でLOOK　CUPとしました。', 80.00, 180.00, 180.00, NULL, '223-0064', '横浜市港北区下田町4-1-2-205', '045-565-1202', '小渕　広光', 0);
INSERT INTO `t_entryinfo` VALUES (3546, '2016-06-13', '営業所西支部', '西川左希子', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03546.jpeg', '', 'composition.Ⅱ', '昨年礒江毅の展覧会に行って刺激を受け静物画を描いてみました。どこまで物質の本質に迫ることができたでしょうか。', 27.00, 41.00, 2.50, NULL, '540-8514', '大阪府大阪市中央区城見2-2-6', '06-6920-5699', '富士通労働組合営業所西支部', 0);
INSERT INTO `t_entryinfo` VALUES (3547, '2016-06-13', '営業所西支部', '田中梨恵', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03547.jpeg', '', '明日をみつめる', '色々な事がある毎日のなかでもうつむかず顔を上げて進めたら。と思い描いてみました。', 24.00, 27.00, 2.00, NULL, '540-8514', '大阪府大阪市中央区城見2-2-6　関西システムラボラトリ', '06-6920-5699', '富士通労働組合　営業所西支部', 0);
INSERT INTO `t_entryinfo` VALUES (3548, '2016-06-13', 'Ｒ＆Ｄ支部', '生澤　敏夫', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03548.jpeg', '', 'おどけるシニア', '30年続く町内の仲間と新緑輝く「松田山」を訪ねた。カメラ嫌いであった若き頃の女性方も最近ではカメラ慣れをしたのかカメラを向けると屈託のない童心に逆戻りをして想いもよらぬ「おどけ姿」を演出する。後日の反省会で写真とビデオを観ながらお腹を抱え、またまた一笑い、二笑い・・・。', 560.00, 740.00, 0.00, NULL, '210-0846', '川崎市川崎区小田5-2-6', '044-333-1374', '生澤　敏夫', 0);
INSERT INTO `t_entryinfo` VALUES (3549, '2016-06-13', '営業所西支部', '築後谷邦子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03549.jpeg', '', 'スワロウテール　生なり', '娘に編みました。ノースリーブのドレスを着たときに使用。編み初めに何回も間違えて10回以上ほどきましたが無事できました。', 165.00, 80.00, 0.00, NULL, '812-0894', '福岡市博多区諸岡2-2-13-701', '092-501-0508', '築後谷邦子', 0);
INSERT INTO `t_entryinfo` VALUES (3550, '2016-06-13', '営業所西支部', '太田淳', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03550.jpeg', '', 'Ｆ14トムキャット', '壁掛けにして戦闘機の躍動感を表現しました。', 60.00, 50.00, 20.00, NULL, '819-0387', '福岡市西区富士見3-4-4', '080-4282-9143', '太田淳', 0);
INSERT INTO `t_entryinfo` VALUES (3551, '2016-06-13', '営業所西支部', '光武利春', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03551.jpeg', '', 'ｆ antasy　ｆ ireworks 161', '夏の風物詩の一つである打上げ花火を、幻想的に見えるように撮っています。毎年打上げ花火をわくわくどきどきしながら撮るのが大好きです。', 61.50, 73.00, 3.00, NULL, '507-0813', '岐阜県多治見市滝呂町9-4-87', '0572-23-9804', '光武利春', 0);
INSERT INTO `t_entryinfo` VALUES (3552, '2016-06-13', '営業所西支部', '土屋功', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03552.jpeg', '', '初節句', '初孫の為に作った五円玉の兜です。', 40.00, 30.00, 25.00, NULL, '488-0872', '尾張旭市平子町長池上6346-17', '0561-52-9433', '土屋功', 0);
INSERT INTO `t_entryinfo` VALUES (3553, '2016-06-13', 'Ｒ＆Ｄ支部', '矢野　信夫', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03553.jpeg', '', '自宅付近からの山岳展望', '自宅付近の公園は海抜約50mあり、秋冬の展望はすばらしく、丹沢の山並、富士山、奥多摩、南アルプスの一部の山も見えます。', 34.00, 44.00, 1.00, NULL, '226-0002', '横浜市緑区東本郷2-17-17', '090-4732-0047', '矢野　信夫', 0);
INSERT INTO `t_entryinfo` VALUES (3554, '2016-06-21', '営業所西支部', '福井英理', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03554.jpeg', '', '母の日のプレゼント', '妻のために作った思い出のバック。子どもたちと一緒に、クラフトテープ（紙テープ）を編んで作り、母の日にプレゼントしました。', 40.00, 35.00, 15.00, NULL, '731-3167', '広島県広島市安佐南区大塚西6丁目8-3-801', '082-848-2274', '福井英理（ひでみち）', 0);
INSERT INTO `t_entryinfo` VALUES (3555, '2016-06-13', '営業所西支部', '栗本点', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03555.jpeg', '', '和気致祥', '和やかな気持ちが幸せをもたらす、そんな心構えで毎日過ごしたいものです。', 86.00, 30.00, 0.00, NULL, '480-1124', '愛知県長久手市戸田谷110-2Ｆ', '090-7047-8740', '山川幸子', 0);
INSERT INTO `t_entryinfo` VALUES (3556, '2016-06-13', 'Ｒ＆Ｄ支部', '谷岡　トシ', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03556.jpeg', '', 'トレッキング', '', 39.40, 50.90, 2.40, NULL, '211-0013', '川崎市中原区上平間1200-4-2-202', '044-548-0869', '谷岡　トシ', 0);
INSERT INTO `t_entryinfo` VALUES (3557, '2016-06-15', '営業所西支部', '牧野彩', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03557.jpeg', '', '泡沫', '毎年きれいに咲く桜ですが、散ってしまうのもあっという間で、今年は特に、満開になった直後の大雨で短い桜でした。消えてしまうものだからこそ、一瞬を大事にしようと思えます。', 25.00, 25.00, 13.00, NULL, '457-0012', '愛知県名古屋市南区菊住1-7-11アリーナシティ203号', '080-1955-0743', '牧野彩', 0);
INSERT INTO `t_entryinfo` VALUES (3558, '2016-06-15', '営業所西支部', '梅村沙代', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03558.jpeg', '', '成長を願う大輪の花', '三歳、七歳の娘の七五三用に作りました。三歳の小さな頭には少し大きすぎましたが娘達もとても気に入ってくれました！', 15.00, 8.00, 5.00, NULL, '470-0136', '愛知県日進市竹の山4-905', '0561-58-1953', '津隈沙代', 0);
INSERT INTO `t_entryinfo` VALUES (3559, '2016-06-13', 'Ｒ＆Ｄ支部', '萩原　正良', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03559.jpeg', '', '朝焼の詩', '冬の12月～2月までの朝、干潮で干潟が出る晴れた日のドラマです。', 55.00, 72.00, 3.00, NULL, '673-0444', '兵庫県三木市別所町東這田548', '0794-82-4321', '萩原　正良', 0);
INSERT INTO `t_entryinfo` VALUES (3560, '2016-06-15', '営業所西支部', '角田晴美', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03560.jpeg', '', '水玉', '雨上がりの庭先にぷくりと現れた水玉に思わず目がとまりました。', 25.40, 30.50, 0.00, NULL, '460-8585', '名古屋市中区錦1-10-1', '052-239-1105', '角田晴美', 0);
INSERT INTO `t_entryinfo` VALUES (3561, '2016-06-13', 'Ｒ＆Ｄ支部', '森田　正男', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03561.jpeg', '', '法隆寺　国宝　五重塔　1/70', '物づくりの現場で培った「切る、削る、組立てる」を基本に、そのための「治具、ヤトイ」を考案しながら製作してみました。', 52.50, 30.00, 30.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3562, '2016-06-13', '営業所西支部', '田中梨恵', NULL, NULL, NULL, NULL, 'B02', 'RA', '', NULL, 'img03562.jpeg', '', '', '線画にチャレンジしました。\r\nひまわりをイメージして描いています。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3563, '2016-06-13', 'Ｒ＆Ｄ支部', '三木　明子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03563.jpeg', '', '平和に満ちた日常', '何気ない日常がいつまでも平和でありますように。', 46.00, 43.00, 7.00, NULL, '390-0315', '松本市岡田町471-1', '0263-45-5326', '三木　明子', 0);
INSERT INTO `t_entryinfo` VALUES (3564, '2016-06-13', '営業所西支部', '横山　千鶴子（横山　若菜）', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '春の日の\r\n我が子　笑顔の\r\n長閑さや', '', '脳出血で入院していた母が退院後、通院先のリハビリ施設で詠んだものです。\r\n退院した喜びが伝わってきたので、私も嬉しくなりました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3565, '2016-06-13', '営業所西支部', '高橋　啓治', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03565.png', '', '', '老人会（ふれあいサロン）にて、落語で大笑いする高齢者。皆さんお元気です。\r\n笑いは健康の源です。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3566, '2016-06-13', '営業所西支部', '牧野　彩', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03566.jpeg', '', '', '夕暮れの風景を写しました。\r\nながめていると、なつかしく、家に帰りたくなるような気持ちになります。\r\n故郷を思う気持ちを大切に、伝えていきたいと思い、出品いたします。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3567, '2016-06-13', '営業所西支部', '巽　利郎', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03567.jpeg', '', '', '自宅の庭に毎年咲くモッコウバラです。今年もいっぱいに咲きました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3568, '2016-06-13', 'Ｒ＆Ｄ支部', '辻村　佑子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03568.jpeg', '', 'アンパンマン☆リース', '子ども達が大好きなアンパンマンの仲間たちを貼り付けた、楽しいリースです。キャラクターはマジックテープで留めてあるので外して遊ぶこともできます。', 34.00, 34.00, 10.00, NULL, '214-0003', '川崎市多摩区菅稲田堤3-17-1　プラザサニーサイド206', '090-8068-9214', '辻村　浩史', 0);
INSERT INTO `t_entryinfo` VALUES (3569, '2016-06-13', '営業所西支部', '吉留　麻衣子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '北九州にある「河内藤園」の大藤です。\r\n藤が大好きな奥様のために育てた個人のお庭が\r\n今は全国の人を魅了する藤園となっています。\r\n未来へ残したい風景の一つです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3570, '2016-06-13', '営業所西支部', '吉留　麻衣子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '北九州にある「河内藤園」の大藤です。\r\n藤が大好きな奥様のために育てた個人のお庭が\r\n今は全国の人を魅了する藤園となっています。\r\n未来へ残したい風景の一つです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3571, '2016-06-13', '営業所西支部', '吉留　麻衣子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '北九州にある「河内藤園」の大藤です。\r\n藤が大好きな奥様のために育てた個人のお庭が\r\n今は全国の人を魅了する藤園となっています。\r\n未来へ残したい風景の一つです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3572, '2016-06-13', '営業所西支部', '吉留　麻衣子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '北九州にある「河内藤園」の大藤です。\r\n藤が大好きな奥様のために育てた個人のお庭が\r\n今は全国の人を魅了する藤園となっています。\r\n未来へ残したい風景の一つです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3573, '2016-06-13', '営業所西支部', '吉留　麻衣子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3574, '2016-06-13', '営業所西支部', '吉留　麻衣子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03574.jpeg', '', '', '北九州にある「河内藤園」の大藤です。\r\n藤が大好きな奥様のために育てた個人のお庭が\r\n今は全国の人を魅了する藤園となっています。\r\n未来へ残したい風景の一つです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3575, '2016-06-13', 'Ｒ＆Ｄ支部', '辻村　知世', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03575.jpeg', '', '家族の笑顔・寝顔', '上段が笑っている顔\r\n下段が寝ている顔', 21.00, 29.70, 0.00, NULL, '214-0003', '神奈川県川崎市多摩区菅稲田堤3-17-1　プラザサニーサイド206', '090-8068-9214', '辻村　浩史', 0);
INSERT INTO `t_entryinfo` VALUES (3576, '2016-06-13', '営業所西支部', '土屋　功', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03576.png', '', '', 'タイトル『裸のつきあい』\r\n娘の子供と息子の子供が久々に会い\r\nいとこが風呂上りのショットです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3577, '2016-06-13', 'Ｒ＆Ｄ支部', '大野　友記子', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03577.jpeg', '', '笑う門には福来たる', '家族がいつも笑顔で幸運が訪れることを願って書きました。', 33.50, 24.50, 0.00, NULL, '211-0053', '川崎市中原区上小田中6-45-1　プレシアスムラタ206', '090-5850-0774', '鈴木　友記子', 0);
INSERT INTO `t_entryinfo` VALUES (3578, '2016-06-13', '営業所西支部', '角田　晴美', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03578.png', '', '', '初秋の高原で、刻々と変化する雲の様子に見とれてしまいました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3579, '2016-06-14', '営業所西支部', '岡本　蘭', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03579.jpeg', '', '', 'これまで親の似顔絵を描いたことがなかったですが、今回の応募を機会に描きました。彼女の中では、一応、顔のポイントを押さえたとのことです。（小学1年）', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3580, '2016-06-14', '営業所西支部', '岡本　葵', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03580.jpeg', '', '', 'いつも夫婦仲良くして欲しいという、娘の気持ちが表れた1枚だと思います。（小学5年）', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3581, '2016-06-14', '営業所西支部', '岡本　蘭', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03581.jpeg', '', '家族', 'これまで親や姉の似顔絵を描いたことがなかったですが、今回の応募を機会に描きました。彼女の中では、一応、顔のポイントを押さえたとのことです。（小学1年）', 27.00, 38.00, 0.00, NULL, '540-8514', '大阪市中央区城見2-2-6関西シスラボ2階富士通労働組合営業所西支部', '06-6920-5699', '岡本　晃', 0);
INSERT INTO `t_entryinfo` VALUES (3582, '2016-06-14', '営業所西支部', '岡本　葵', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03582.jpeg', '', '夫婦仲良く', 'いつも仲良くして欲しいという、娘の気持ちが表れた1枚だと思います。（小学5年） ', 27.00, 38.00, 0.00, NULL, '540-8514', '大阪市中央区城見2-2-6関西シスラボ2階富士通労働組合営業所西支部', '06-6920-5699', '岡本　晃', 0);
INSERT INTO `t_entryinfo` VALUES (3583, '2016-06-14', '営業所西支部', '山中　眞紀', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03583.png', '', '', '同級生', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3584, '2016-06-15', '営業所西支部', '山中　佳穏', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03584.png', '', 'そら', '頑張って、書いてみました。', 39.00, 27.00, 0.00, NULL, '612-8363', '京都市伏見区納屋町136-1-304', '075-622-6929', '山中　佳穏', 0);
INSERT INTO `t_entryinfo` VALUES (3585, '2016-06-15', '営業所西支部', '山中　美穏', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03585.png', '', 'さる', '頑張って、書いてみました。', 39.00, 27.00, 0.00, NULL, '612-8363', '京都市伏見区納屋町136-1-304', '075-622-6929', '山中　美穏', 0);
INSERT INTO `t_entryinfo` VALUES (3586, '2016-06-15', '営業所西支部', '山中　眞紀', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03586.png', '', 'まきの軍艦巻', '子供と一緒にお寿司屋さんごっこを楽しみました。', 10.00, 25.50, 17.50, NULL, '612-8363', '京都市伏見区納屋町136-1-304', '075-622-6929', '山中　眞紀', 0);
INSERT INTO `t_entryinfo` VALUES (3587, '2016-06-15', 'ソフト・サービス支部', '近藤　樹', NULL, NULL, NULL, NULL, 'B02', 'RA', '', NULL, 'img03587.jpeg', '', '', '未来に向かって、力いっぱい生きる力を表現しました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3588, '2016-06-14', 'ソフト・サービス支部', '高橋　浩美', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03588.jpeg', '', '千字文', '４０歳代最後の記念に千字に挑戦しましたが、何度も失敗し、やっとの思いで仕上げた作品です。', 136.00, 70.00, 1.00, NULL, '370-0701', '群馬県邑楽郡明和町南大島177', '090-3205-6638', '高橋　浩美', 0);
INSERT INTO `t_entryinfo` VALUES (3589, '2016-06-15', 'ソフト・サービス支部', '石崎　千恵', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03589.jpeg', '', '', '笑顔・元気になれるモノ\r\n子供の笑顔を見ていると、まわりも自然と笑顔になってしまいます。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3590, '2016-06-15', '営業所西支部', '田中　さりな', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03590.jpeg', '', '水音', '「はらい」の部分をがんばってたくさん練習しました。', 42.00, 30.00, 0.00, NULL, '554-0012', '大阪府大阪市此花区西九条6-1-125-319', '090-8216-2612', '田中　義浩', 0);
INSERT INTO `t_entryinfo` VALUES (3591, '2016-06-14', '本社支部', '別府　明子', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03591.jpeg', '', '五月の歌', '「五月雨は晴れぬとみゆる雲間より　山の色こき　夕ぐれの空」宗尊親王\r\n社会人になってから習い始めた書道。\r\n少しは上達したかな…？', 82.00, 27.00, 0.00, NULL, '272-0132', '千葉県市川市湊新田2-8-18　ファミール行徳305号', '090-8943-2761', '別府　幸治', 0);
INSERT INTO `t_entryinfo` VALUES (3592, '2016-06-14', '本社支部', '岩城　史生', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03592.jpeg', '', '伊達家直参　五葉山火縄銃鉄砲隊', '平成の世において伊達家を支える五葉山火縄銃鉄砲隊。\r\n毎年春に行われる青葉祭りでは、伊達家十八代当主とともに街を練り歩きます。', 36.50, 31.50, 0.00, NULL, '981-1106', '宮城県仙台市太白区柳生４－１７－２－５０４', '022-306-6803', '岩城史生', 0);
INSERT INTO `t_entryinfo` VALUES (3593, '2016-06-17', '本社支部', '藤谷　秀明', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03593.jpeg', '', 'どこにあったかな？', 'ゴジュウカラが木の皮の間に隠した木の実を探してつついている。', 25.40, 30.50, 0.00, NULL, '064-0927', '札幌市中央区南27条西8丁目1-35', '011-562-2043', '藤谷　秀明', 0);
INSERT INTO `t_entryinfo` VALUES (3594, '2016-06-14', 'ソフト・サービス支部', '甲斐　亮二', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03594.png', '', 'シウマイ弁当ゴルフヘッドカバー', 'ゴルフのドライバーのヘッドカバーを手編みで製作しました。\r\n数ある作品の中から、最も難易度の高かった作品をエントリーいたします。シウマイ弁当をモチーフに細かい部分まで毛糸で編んで表現しました。包み紙の横浜の町並みをデザインした図柄や、ドラゴンのモチーフもフェルトを縫い付けて再現しています。シウマイ、白米、筍煮、焼き魚、かまぼこ、卵焼き、唐揚げ、バラン、昆布佃煮と言った内容も、毛糸とフェルトで細部まで再現しました。実際にゴルフコースでラウンド中、カラスにシウマイ１個と梅干をむしり取られた経歴もあります。', 35.00, 15.00, 20.00, NULL, '370-0504', '群馬県邑楽郡千代田町舞木２６１９', '080-6544-6742', '甲斐　亮二', 0);
INSERT INTO `t_entryinfo` VALUES (3595, '2016-06-16', 'ソフト・サービス支部', '倉本　拓実', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03595.jpeg', '', '初めての書き初め', '書き初め選手になりたくて、一生懸命練習した時の１枚です。', 78.00, 26.00, 0.00, NULL, '360-0002', '埼玉県熊谷市大塚２３２－１', '090-1432-6278', '倉本　拓実', 0);
INSERT INTO `t_entryinfo` VALUES (3596, '2016-06-14', 'ソフト・サービス支部', '大橋　格仁', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03596.jpeg', '', '', '春のおとずれを感じさせる河津桜', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3597, '2016-06-14', 'ソフト・サービス支部', '川辺　紫', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03597.png', '', '', 'one heart　　one mind　　･･･心はひとつ\r\n\r\nIPKNOWLEDGE（アイピーナレッジ）は、私たちみんなで開発しているパッケージです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3598, '2016-06-14', 'ソフト・サービス支部', '富原　望', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03598.jpeg', '', '楽園', '熱海のソーダイ根というダイビングポイントに潜ったら綺麗な景色に出会いました。', 50.00, 40.00, 2.00, NULL, '213-0011', '川崎市高津区久本3-6-3-1307', '090-6521-0908', '富原　望', 0);
INSERT INTO `t_entryinfo` VALUES (3599, '2016-06-14', 'ソフト・サービス支部', '平野　政昭', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03599.jpeg', '', '鉄砂釉大壷', '５kgの土で「ろくろ」一体成形品。\r\n高さを出すのに苦労した。', 28.00, 25.00, 25.00, NULL, '374-0027', '館林市富士見町14-24', '0276-74-2307', '平野　政昭', 0);
INSERT INTO `t_entryinfo` VALUES (3600, '2016-06-14', 'ソフト・サービス支部', '頼　冠香', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03600.jpeg', '', '蓮の花と娘', '', 42.00, 32.00, 0.00, NULL, '212-0024', '川崎市幸区塚越4-314-5プライム川崎矢向309', '080-5172-9950', '頼　冠香', 0);
INSERT INTO `t_entryinfo` VALUES (3601, '2016-06-15', 'ソフト・サービス支部', '當間　孝博', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03601.jpeg', '', '', '雨上がり、たんぽぽを見つけ風おくり。飛ぶまで近づき、しゃがみ込む様子がおもしろく。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3602, '2016-06-14', 'ソフト・サービス支部', '野田　訓', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03602.jpeg', '', '', 'えいえいおー！\r\n全米で最も美しいビーチにも選ばれたラニカイビーチ(ハワイ）にて', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3603, '2016-06-14', 'ソフト・サービス支部', '今井　勝志', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, '', '', '都会の夕日', 'お台場海浜公園から見た品川埠頭', 24.00, 32.80, 1.00, NULL, '374-0024', '群馬県館林市本町2-11-31　サルートリベルテ館林303号', '0276-74-0925', '今井　勝志', 1);
INSERT INTO `t_entryinfo` VALUES (3604, '2016-06-21', 'ソフト・サービス支部', '今井　勝志', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03604.png', '', '都会の夕日', 'お台場海浜公園から見た品川埠頭', 24.00, 32.80, 1.00, NULL, '374-0024', '群馬県館林市本町2-11-31　サルートリベルテ館林303号', '0276-74-0925', '今井　勝志', 0);
INSERT INTO `t_entryinfo` VALUES (3605, '2016-06-14', 'ソフト・サービス支部', '菅野　博介', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03605.jpeg', '', '激闘', '角突きの激しさを目で表現している。（新潟県山古志村にて）\r\n', 54.50, 65.00, 3.00, NULL, '361-0023', '埼玉県行田市長野４－１０－１１', '048-559-2364', '菅野　博介', 0);
INSERT INTO `t_entryinfo` VALUES (3606, '2016-06-14', '営業所西支部', '森本　茂樹', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, '', '', '古豪疾走', '旧日銀広島支店の前を走る、旧京都市電。\r\n古くても残しておきたい風景です。', 25.40, 30.50, 0.00, NULL, '739-0476', '広島県廿日市市大野高見362', '0829-56-4676', '森本　茂樹', 1);
INSERT INTO `t_entryinfo` VALUES (3607, '2016-06-14', 'ソフト・サービス支部', '延命　晋一郎', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03607.jpeg', '', '', 'みんな同じ空の下で生きている。\r\nそう思うと元気が出てきます。（多摩川河川敷）\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3608, '2016-06-14', 'ソフト・サービス支部', '高木　克彦', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03608.jpeg', '', '清光の初夏', '光の束のように流れる滝。\r\n汗ばむ初夏の日に清々しいひとときでした。\r\n（山梨県の西沢渓谷にて撮影）', 45.00, 56.00, 0.00, NULL, '140-0013', '東京都品川区南大井3-14-16-501', '080-5549-1221', '高木　克彦', 0);
INSERT INTO `t_entryinfo` VALUES (3609, '2016-06-14', '営業所西支部', '森本　茂樹', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03609.png', '', '古豪疾走', '旧日銀広島支店の前を走る、旧京都市電。\r\n古くても残しておきたい風景です。', 25.40, 30.50, 0.00, NULL, '739-0476', '広島県廿日市市大野高見362', '0829-56-4676', '森本　茂樹', 0);
INSERT INTO `t_entryinfo` VALUES (3610, '2016-06-14', 'ソフト・サービス支部', '坪井　俊介', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03610.jpeg', '', '', 'テーマ：未来に残したいモノ\r\n　取り壊された旧広島市民球場のライトスタンド（観客席部分）です。\r\n　現在は新しい市民球場（マツダスタジアム）に盛り上がりを譲っていますが、戦後から広島市民に夢と希望を与え続けた旧広島市民球場のライトスタンドはファンの熱意により、解体されずに残されています。\r\n　球場跡地がどのように再生されるかわかりませんが、ファンの思い出が詰まったライトスタンドは原爆ドームと共に未来に残したいモノであります。\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3611, '2016-06-14', '営業所西支部', '原田　綾花', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03611.png', '', '魔女のすむ家', '絵本の1シーンのつもりで描きました。画材はアクリル、4号サイズのキャンパスに描きました。', 24.30, 33.40, 1.80, NULL, '451-0025', '愛知県名古屋市西区上名古屋2-20-16レオパレス浄心403号室', '080-5758-4790', '原田　綾花', 0);
INSERT INTO `t_entryinfo` VALUES (3612, '2016-06-14', 'Ｒ＆Ｄ支部', '山田  奈々', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03612.jpeg', '', '空港', '心を込めて一生懸命書きました。', 33.30, 24.20, 0.00, NULL, '929-0342', '石川県河北郡津幡町北中条5-45', '076-289-0871', '山田　奈々', 0);
INSERT INTO `t_entryinfo` VALUES (3613, '2016-06-14', 'ソフト・サービス支部', '加納 正裕', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03613.jpeg', '', '二足のわらじ　メタルバンド　～大赤字血祭り編～', '　拙者、趣味ですが、真摯にバンド活動に取り組んでおります。ジャンルはメタルの中でもエレクトロニコア。\r\n　ライヴは月に３～５本。美と轟きが共存した音で、世界や生の美しさ、力強さ、残酷さなど表現します。\r\n　日本は、先入観の影響もあり、メタル需要が低く、大赤字なので、拙者、わらじすら履けず、はだしです。\r\n　おおきに、ありがとうございます。', 45.70, 56.00, 0.00, NULL, '211-0005', '川崎市中原区新丸子町759-1-502', '080-5358-7131', '加納 正裕', 0);
INSERT INTO `t_entryinfo` VALUES (3614, '2016-06-14', '営業所西支部', '原田　綾花', NULL, NULL, NULL, NULL, 'B02', 'RA', '', NULL, 'img03614.png', '', '', '一昨年参加した、友人の結婚式に感銘を受けて描きました（花婿の職業が消防士のため、礼服での結婚式）。\r\n友人の今後の幸せを祈りながら。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3615, '2016-06-14', '営業所西支部', '四ヶ所　里美', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03615.jpeg', '', '', '初めての広い芝生でおおはしゃぎ！', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3616, '2016-06-14', 'Ｒ＆Ｄ支部', '山田　健太', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03616.jpeg', '', '小川', 'がんばって書きました。', 33.30, 24.20, 0.00, NULL, '929-0342', '石川県河北郡津幡町北中条5-45', '076-289-0871', '山田　健太', 0);
INSERT INTO `t_entryinfo` VALUES (3617, '2016-06-15', '営業所西支部', '神崎　聡大', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03617.jpeg', '', '公明正大', '丁寧に書けたので出品します。', 33.00, 24.00, 0.00, NULL, '666-0261', '兵庫県川辺郡猪名川町松尾台2-1-12-F303', '072-766-5856', '神崎　聡大', 1);
INSERT INTO `t_entryinfo` VALUES (3618, '2016-06-14', 'Ｒ＆Ｄ支部', '近藤　康子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03618.jpeg', '', '天空からメーリー・クリスマス！！', '昨年のクリスマスシーズンに入り、今回はどこのイルミネーションを見ようと思ったところ、六本木周辺や高い所から東京タワーが見たくなり家族と出かけました。\r\nクリスマスカラーにライトアップされたタワーとキレイな夜景を残したくて、シャッターを切りました。', 39.70, 49.00, 3.00, NULL, '211-0041', '神奈川県川崎市中原区下小田中2-21-1-103', '090-1855-9231', '飯島　康子', 0);
INSERT INTO `t_entryinfo` VALUES (3619, '2016-06-14', 'Ｒ＆Ｄ支部', '中島　智子', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03619.jpeg', '', 'Ｓｅｃｒｅｔ　Ｇａｒｄｅｎ', '水彩と色エンピツでノスタルジックな雰囲気と優しい光を表現しました。原作者画家の玉神輝美先生の許可を得て、一部模写し、アレンジをして描き上げました。', 64.00, 48.00, 2.80, NULL, '323-0806', '栃木県小山市中久喜1-9-8', '090-1123-3641', '中島　智子', 0);
INSERT INTO `t_entryinfo` VALUES (3620, '2016-06-14', 'Ｒ＆Ｄ支部', '伊藤　孝行', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03620.jpeg', '', '仏画', '３年前に他界した父の遺品を整理していた時に、父が使用していた岩絵具と、「重要」と書かれた封筒を見つけました。封筒の中には、私が小学生の時に将来の夢を書いた文集でした。父は私達兄弟を自宅の裏山の空き地で、よく武道や日本画を教えてくれました。兄弟全員に空手着や学生服を着せて、子供の成長記録を父親が勤務する会社の社報にある家族欄で紹介したことを覚えています。父がしてくれたように、私も自分が勤務する会社の展示会で出展することを決意し、大切に育ててくれた父に感謝を込めながら、父が愛用していた岩絵具を使って仏画を描き', 37.30, 32.00, 3.00, NULL, '234-0052', '横浜市港南区笹下3-6-11', '080-1162-9997', '伊藤　孝行', 0);
INSERT INTO `t_entryinfo` VALUES (3621, '2016-06-14', 'Ｒ＆Ｄ支部', '東海林　ミモザ', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03621.jpeg', '', '赤ちゃんへ～初めての布絵本～', '娘のために、口に入れても大丈夫な布で絵本を作りました。表紙には刺しゅう、中のページを開くと動くしかけや触って楽しい工夫をたくさん作りました。おでかけにもぴったり。', 15.00, 25.00, 1.00, NULL, '206-0012', '東京都多摩市貝取5-2-9-501', '080-5415-0550', '東海林　ミモザ', 1);
INSERT INTO `t_entryinfo` VALUES (3622, '2016-06-14', 'Ｒ＆Ｄ支部', '佐藤　俊昭', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03622.jpeg', '', 'マイパートナー', '晩酌の良きパートナーです。', 10.00, 10.00, 10.00, NULL, '211-8588', '川崎市中原区上小田中4-1-1　富士通労働組合Ｒ＆Ｄ支部', '044-754-2583', '本城　信行', 0);
INSERT INTO `t_entryinfo` VALUES (3623, '2016-06-14', 'Ｒ＆Ｄ支部', '石田　和昭', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03623.jpeg', '', '涼', '涼やかな滝の音が聞こえてきますでしょうか？', 62.00, 76.00, 0.00, NULL, '252-0021', '神奈川県座間市緑ヶ丘2-10-18', '090-7831-8979', '石田　和昭', 0);
INSERT INTO `t_entryinfo` VALUES (3624, '2016-06-14', 'Ｒ＆Ｄ支部', '高橋　沙希', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03624.jpeg', '', 'たごとのつき', '水田1枚1枚に月が映るという「田毎の月」。実際には見ることはできません。が、昔は浮世絵に描き、俳句に詠み、現在は地域に暮らす人々が鏡を使って実現させようと試みる。多くの人に惹かれるその美しい心象風景に、私も惹かれました。', 46.00, 38.00, 0.00, NULL, '145-0076', '東京都大田区田園調布南21-9-504　シュロス田園調布南', '070-5622-9202', '高橋　沙希', 0);
INSERT INTO `t_entryinfo` VALUES (3625, '2016-06-15', '営業所西支部', '神崎　聡大', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03625.jpeg', '', '公明正大', '丁寧に書けたので出品します。', 33.00, 24.00, 0.00, NULL, '666-0261', '兵庫県川辺郡猪名川町松尾台2-1-12-F303', '072-766-5856', '神崎　聡大', 0);
INSERT INTO `t_entryinfo` VALUES (3626, '2016-06-15', '小山支部', '小口　紀子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03626.jpeg', '', '', '初めてのいちご狩り♪', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3627, '2016-06-15', '小山支部', '前原　武夫', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03627.jpeg', '', '', 'どちらがいいかおかな？', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3628, '2016-06-15', '小山支部', '木村　陽一', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03628.jpeg', '', '', '大好き!!おばあちゃん', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3629, '2016-06-15', '小山支部', '海老沼　弘', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03629.jpeg', '', '', '我が家のペット「バニー」です。全身真っ白のかわいい女の子です。仕事で疲れた時など　見ているだけで癒されます。応募写真ですが少しでも和やかな気持ちになれればと思いエントリーしました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3630, '2016-06-15', '小山支部', '佐藤　信子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03630.jpeg', '', '', 'フラワーシャワーを浴びて、輝く顔・顔・顔･･･「笑顔は最高!!」\r\nゲストの私たちも　とっても幸せな気持ちになりました。\r\n二人の目標は「笑顔いっぱいの家庭を作ること」', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3631, '2016-06-15', '小山支部', '佐藤　愛作', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03631.jpeg', '', '', '栃木県にある井頭公園でのスナップ写真です。\r\nアヒルの家族もお出かけです。一列縦隊でさあー出発\r\n今日も一日元気で頑張るぞ～', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3632, '2016-06-16', '小山支部', '北條　博三郎', NULL, NULL, NULL, NULL, 'B03', 'RA', '', NULL, '', '災害で　皆助けあう　絆あり', '', '今回の九州熊本の地震の災害でのすさまじい場景を見て　助けあう情報が全国に広がり特に熊本や大分に義援金を振込まれ絆の強さを感じた', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3633, '2016-06-15', '沼津支部', '植木　克江', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03633.jpeg', '', '', 'エッフェル塔\r\nパリ観光中、偶然結婚式に遭遇。\r\nフランス人？\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3634, '2016-06-15', '沼津支部', '植木　華代', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03634.jpeg', '', '', '小さい子は、物まね好き。\r\n大人のまねして、『セクシーポーズ』\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3635, '2016-06-15', '沼津支部', '小林　由聖', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '運動会　きずな深めた　バトンリレー', '', 'ぼくのクラスは足の遅い人が多かったけど、運動会までリレーの練習を毎日やりました。ビリになってしまったけど、みんなで力をあわせてゴールできてよかったです', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3636, '2016-06-15', '沼津支部', '森野　盛人', NULL, NULL, NULL, NULL, 'B03', 'RA', '', NULL, '', '新メンバ　絆づくりは　笑顔から', '', '職場内の絆\r\n（新しい職場に異動し、まわりの人たちと笑顔で接して、絆づくりをはじめたい）\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3637, '2016-06-15', '沼津支部', '森野　盛人', NULL, NULL, NULL, NULL, 'B05', 'RA', '', NULL, '', '進化する　繋がり方は　ＩＴで　離れた人の　心をつなぐ', '', 'ＩＴで変化する人と人とのつながり\r\n（遠方の人とコミュニケーションがとれなかったが、いろいろなＩＴツールは、コミュニケーションを可能に変えてくれた様子）\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3638, '2016-06-15', '沼津支部', '森野　盛人', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '新年会　兄弟姉妹で　母見舞う', '', '家族の絆\r\n（入院中で、新年会にでれなかった母を、兄弟姉妹そろって、お見舞いにいった様子）\r\n', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3639, '2016-06-15', '沼津支部', '杉山　徹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03639.jpeg', '', '', 'お風呂の中で気持ちよさそうに足をバタバタ「いい湯だな」と語りかけているように思います。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3640, '2016-06-20', '沼津支部', '工藤　貴子', NULL, NULL, NULL, NULL, 'B03', 'RA', '', NULL, '', '残業との　　つながりを断ち　趣味探す', '', '仕事だけではなく、自分の時間を充実させたい思いをこめました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3641, '2016-06-15', '沼津支部', '中嶋　美砂子', NULL, NULL, NULL, NULL, 'B05', 'RA', '', NULL, '', '指先の　爪の形が　真四角で　祖母と同じと　つながりをみる', '', '短歌は、祖母が亡くなったときに印象的だったことを思い出して詠みました。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3642, '2016-06-15', '沼津支部', '渡辺よしの', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03642.jpeg', '', 'TBSドラマ・下町ロケット　「佃製作所の外村です。」', '総合センター２０周年記念事業「立川談春」独演会のパンフレットに採用された肖像画です。本作と沼津支部の「渋ちゃんボールペン」のイラスト画の二つは自身渾身の作です。', 74.00, 59.00, 2.00, NULL, '1450071', '東京都大田区田園調布4丁目３５－１５', '0357555648', '渡辺　彩水', 0);
INSERT INTO `t_entryinfo` VALUES (3643, '2016-06-15', '沼津支部', '芹澤　奈々', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03643.jpeg', '', '牧場', '一生懸命書きました', 42.00, 30.00, 0.00, NULL, '4100106', '静岡県沼津市志下７８－２', '09010494350', '芹澤　珠美', 0);
INSERT INTO `t_entryinfo` VALUES (3644, '2016-06-15', '沼津支部', '芹澤　亜美', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03644.jpeg', '', '川', '一生懸命書きました', 42.00, 30.00, 0.00, NULL, '4100106', '静岡県沼津市志下７８－２', '09010494350', '芹澤　珠美', 0);
INSERT INTO `t_entryinfo` VALUES (3645, '2016-06-15', '小山支部', '渡辺　佳子', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03645.jpeg', '', '', '〇年前の私　ほほえむ笑顔\r\n昔をふり返る事が出来る思い出の写真\r\nいつまでも残しておきたいです。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3646, '2016-06-15', '沼津支部', '吉松　花音', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03646.jpeg', '', 'かねの音', '一字一字ていねいに書くように心がけました。', 24.00, 33.00, 0.00, NULL, '4101123', '静岡県裾野市伊豆島田１２－１ ウィスティリア裾野708号室', '0559936707', '吉松　清庸', 0);
INSERT INTO `t_entryinfo` VALUES (3647, '2016-06-15', '小山支部', '須藤　晃代', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03647.jpeg', '', '益子焼', '大きな器作りにチャレンジ!!\r\nまさに力作です', 24.00, 25.00, 10.00, NULL, '323-0155', '栃木県小山市福良308-2', '0296-32-0976', '須藤　晃代', 0);
INSERT INTO `t_entryinfo` VALUES (3648, '2016-06-15', '沼津支部', '加藤めぐみ', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03648.jpeg', '', '継', '「継続は力なり」、大切にしている言葉の一つです。\r\n自然に割れた筆先を活かして、筆を構成する毛の一本一本の動きまで意識しながらどこまでも続いていく(＝継続)ような気持ちを込めました。\r\n', 104.00, 60.00, 0.00, NULL, '4300901', '浜松市中区曳馬3-23-8', '0534642148', '加藤めぐみ', 0);
INSERT INTO `t_entryinfo` VALUES (3649, '2016-06-15', '沼津支部', '柳澤　芳二', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03649.jpeg', '', '『な～に！』', 'カメラを向けたら「な～に！」と言われていると感じで、凄く癒やされる写真が撮れました。', 26.00, 31.00, 0.00, NULL, '4100312', '静岡県沼津市原1721-109', '0559668240', '柳澤　芳二', 0);
INSERT INTO `t_entryinfo` VALUES (3650, '2016-06-16', '小山支部', '三浦　敦子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03650.jpeg', '', 'パッチワーク　レッスンバッグ', '娘のピアノレッスン用に頑張って作りました。', 30.00, 40.00, 3.00, NULL, '323-0820', '栃木県小山市西城南3-8-23', '0285-28-0406', '三浦　敦子', 1);
INSERT INTO `t_entryinfo` VALUES (3651, '2016-06-15', '小山支部', '武部　千恵子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03651.jpeg', '', 'ベビードレス', 'かぎ針、初めての挑戦で編みました。', 100.00, 60.00, 0.00, NULL, '307-0001', '茨城県結城市結城11916-10', '0296-33-0383', '武部　千恵子', 1);
INSERT INTO `t_entryinfo` VALUES (3652, '2016-06-15', '沼津支部', '植木　華代', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03652.jpeg', '', 'ノルウェー　ハダンゲルフィヨルド', 'ノルウェーの幻想的な大自然は映画『アナと雪の女王』の舞台になったことで知られています。\r\n青いフィヨルドの水面に反射した圧倒されるほど美しい風景に感動しました。\r\n', 30.00, 35.00, 2.00, NULL, '4100304', '静岡県沼津市東原４３９－１５', '0559662106', '植木　華代', 0);
INSERT INTO `t_entryinfo` VALUES (3653, '2016-06-16', '小山支部', '皮籠石　久美子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03653.jpeg', '', 'パイナップル模様のチュニック', '本の中でかわいいパイナップル模様のチュニックがあったので夏に向けて編みました。', 65.00, 50.00, 0.00, NULL, '323-0829', '栃木県小山市東城南3-16-25', '0285-27-9858', '皮籠石　久美子', 1);
INSERT INTO `t_entryinfo` VALUES (3654, '2016-06-16', '小山支部', '沼山　道子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03654.jpeg', '', 'アンサンブル', 'おしゃれしてパーティーに行きたいなぁ', 60.00, 50.00, 0.00, NULL, '306-0402', '茨城県猿島郡境町猿山273-7', '0280-87-4710', '沼山　道子', 1);
INSERT INTO `t_entryinfo` VALUES (3655, '2016-06-15', '沼津支部', '小股　英樹', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03655.jpeg', '', '紅色に染まる', '厳冬期、山中湖村の花の都公園から夜明けの富士を撮影。少しづつ紅色に染まっていくのを狙って撮影した1枚です', 45.00, 54.00, 2.00, NULL, '4110901', '静岡県駿東郡清水町新宿244-1 アーバンシティー新宿510', '0559727308', '小股　英樹', 0);
INSERT INTO `t_entryinfo` VALUES (3656, '2016-06-15', '沼津支部', '稲葉　博正', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03656.jpeg', '', '波濤(はとう)と富士', '紺碧の空！雲よりも高くそびえる富士　磯に打ち寄せる波が富士に負けじと高く舞い上がる一瞬を撮影しました。', 65.00, 78.00, 2.00, NULL, '4190112', '静岡県田方郡函南町柏谷1017-17', '0559789734', '稲葉　博正', 0);
INSERT INTO `t_entryinfo` VALUES (3657, '2016-06-15', '沼津支部', '鈴木　りつ子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03657.jpeg', '', '親子でおでかけ♪', '花結びあみの手提げバッグです。\r\nサイズ違いで作ってみました。\r\n', 38.00, 30.00, 13.00, NULL, '4110033', '静岡県三島市文教町2-24-22-410', '0559895354', '鈴木　りつ子', 0);
INSERT INTO `t_entryinfo` VALUES (3658, '2016-06-15', '沼津支部', '柳澤　裕子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03658.jpeg', '', 'スター(星)のボストンバック', 'ちょっとした日帰り旅行に持っていきやすいバックを作りました。', 21.00, 35.00, 13.00, NULL, '4100312', '静岡県沼津市原1721-109', '0559668240', '柳澤　裕子', 0);
INSERT INTO `t_entryinfo` VALUES (3659, '2016-06-15', '沼津支部', '木村　公美', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03659.jpeg', '', 'アヤメ', '満開の菖蒲を友禅染で表現しました', 40.00, 35.00, 0.00, NULL, '4160948', '富士市森島１３６－３', '0545618011', '木村　清美', 0);
INSERT INTO `t_entryinfo` VALUES (3660, '2016-06-15', '沼津支部', '木村　公親', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03660.jpeg', '', '鶏', '美しい鶏の後姿を鮮やかな色彩で描きました', 54.00, 47.00, 4.00, NULL, '4160948', '富士市森島１３６－３', '0545618011', '木村　清美', 0);
INSERT INTO `t_entryinfo` VALUES (3661, '2016-06-15', '沼津支部', '石田　楓', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03661.jpeg', '', 'かぼちゃ', '煮物にするとおいしそうなかぼちゃです', 10.00, 11.00, 11.00, NULL, '4100305', '静岡県沼津市鳥谷82-10', '0559675133', '石田　楓', 0);
INSERT INTO `t_entryinfo` VALUES (3662, '2016-06-15', 'ソフト・サービス支部', '武智　陽子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03662.png', '', '夕暮れの海', '自然に包まれた一枚です。', 30.00, 20.00, 2.00, NULL, '227-0045', '横浜市青葉区若草台8-34', '090-7283-1247', '武智　陽子', 0);
INSERT INTO `t_entryinfo` VALUES (3663, '2016-06-15', '沼津支部', '小川和広', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03663.jpeg', '', '紙バンド「にわとり親子」', 'バッグや小物入れより時間がかかる物にチャレンジ！　編み目の細かさに注意して仕上げました。', 26.00, 17.00, 25.00, NULL, '4101123', '静岡県裾野市伊豆島田６５８－８', '0559926620', '小川 朋子', 0);
INSERT INTO `t_entryinfo` VALUES (3664, '2016-06-15', '沼津支部', '佐藤　恵里奈', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03664.jpeg', '', '新しい年の始まり', '未年の新しい年の初めに書き初めをしました。', 112.00, 26.00, 0.00, NULL, '4100875', '静岡県沼津市今沢545-4　K16-203', '0559669825', '佐藤恵里奈', 0);
INSERT INTO `t_entryinfo` VALUES (3665, '2016-06-15', 'ソフト・サービス支部', '武智　亜希子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03665.png', '', '頂上からの景色', '趣味の登山で撮影した一枚です。\r\nこの景色が登山の醍醐味です。', 30.00, 20.00, 2.00, NULL, '227-0045', '横浜市青葉区若草台8-34', '090-7283-1247', '武智　陽子', 0);
INSERT INTO `t_entryinfo` VALUES (3666, '2016-06-15', '沼津支部', '金澤　智保', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03666.jpeg', '', '瑞気集門', '「めでたいことが起る兆しの氣が、すでにあなたの玄関先に集まっている」という意味です。', 43.00, 186.00, 0.00, NULL, '4110019', '三島市松が丘4-10', '0559810053', '金澤　智保', 0);
INSERT INTO `t_entryinfo` VALUES (3667, '2016-06-15', 'ソフト・サービス支部', '武智　邦子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03667.jpeg', '', '多民族', '色々な民族衣装をモチーフにしました。', 50.00, 80.00, 0.00, NULL, '227-0045', '横浜市青葉区若草台8-34', '090-7283-1247', '武智　陽子', 0);
INSERT INTO `t_entryinfo` VALUES (3668, '2016-06-16', '小山支部', '福田　晴枝', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '娘の七五三の前撮りで、み～んな笑顔♡', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3669, '2016-06-16', '小山支部', '福田　晴枝', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '娘の七五三の前撮りで、み～んな笑顔♡', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3670, '2016-06-16', '小山支部', '福田　晴枝', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03670.jpeg', '', '', '娘の七五三の前撮りで、み～んな笑顔♡', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3671, '2016-06-16', '小山支部', '福田　晴枝', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, '', '', '', '娘の七五三の前撮りで、み～んな笑顔♡', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3672, '2016-06-16', '小山支部', '海老原　理水', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03672.jpeg', '', '', 'はとこで結婚??', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3673, '2016-06-16', 'Ｒ＆Ｄ支部', '山内　結衣', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 33.00, 24.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '山内　久美子', 1);
INSERT INTO `t_entryinfo` VALUES (3674, '2016-06-16', 'Ｒ＆Ｄ支部', '山内　結衣', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 33.00, 24.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '山内　久美子', 1);
INSERT INTO `t_entryinfo` VALUES (3675, '2016-06-16', 'Ｒ＆Ｄ支部', '山内　結衣', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3676, '2016-06-16', 'Ｒ＆Ｄ支部', '山内', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3677, '2016-06-16', '小山支部', '海老原　理水', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03677.jpeg', '', '', '大きくなっても仲良しだよ。', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3678, '2016-06-16', 'Ｒ＆Ｄ支部', '山内　結衣', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 33.00, 25.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '山内　久美子', 1);
INSERT INTO `t_entryinfo` VALUES (3679, '2016-06-16', 'Ｒ＆Ｄ支部', '山内　結衣', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 33.00, 25.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '山内　久美子', 1);
INSERT INTO `t_entryinfo` VALUES (3680, '2016-06-16', 'Ｒ＆Ｄ支部', '山内', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, '', '', '未来', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 1);
INSERT INTO `t_entryinfo` VALUES (3681, '2016-06-16', 'Ｒ＆Ｄ支部', '茨木　照夫', NULL, NULL, NULL, NULL, 'B04', 'RA', '', NULL, '', '人生の　燃えさかりたる　友仲間', '', '', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3682, '2016-06-16', '沼津支部', '服部　智', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03682.jpeg', '', '', '未来に残したい青い海', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3683, '2016-06-16', '沼津支部', '諏訪文音', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03683.jpeg', '', '花', 'きれいな花', 0.00, 0.00, 0.00, NULL, '4170001', '静岡県富士市今泉2526-25', '09040882561', '諏訪辰弥', 0);
INSERT INTO `t_entryinfo` VALUES (3684, '2016-06-16', 'Ｒ＆Ｄ支部', '山内　結衣', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03684.jpeg', '', '未来', '', 33.00, 24.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '山内　久美子', 0);
INSERT INTO `t_entryinfo` VALUES (3685, '2016-06-16', '沼津支部', '金澤　美保', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03685.jpeg', '', '麗日發光華', '「麗らかな春の日に全ての物が輝いている」という意味です', 22.00, 112.00, 0.00, NULL, '4110019', '三島市松が丘4-10', '0559810053', '金澤 美保', 0);
INSERT INTO `t_entryinfo` VALUES (3686, '2016-06-16', 'Ｒ＆Ｄ支部', 'まつお　みゆ', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03686.jpeg', '', '父の日', '', 33.00, 24.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '松尾　剛志', 0);
INSERT INTO `t_entryinfo` VALUES (3687, '2016-06-16', '沼津支部', '植木　克江', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03687.jpeg', '', 'スペイン　サグラダファミリア', '現在も建設中の大聖堂で、日本人の外尾悦郎さんが主任彫刻家として活躍中です。\r\n写真の外装は有名ですが、内装も素敵です。柱、天井が白で統一され、ステンドグラスから光が射す光景は本当に綺麗です。\r\n', 31.00, 36.00, 2.00, NULL, '4100304', '静岡県沼津市東原４３９－１５', '0559662106', '植木　克江', 0);
INSERT INTO `t_entryinfo` VALUES (3688, '2016-06-16', 'Ｒ＆Ｄ支部', '鶴見　桃子', NULL, NULL, NULL, NULL, 'C02', 'RI', '', NULL, 'img03688.jpeg', '', '土', '', 33.00, 24.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '鶴見　華代', 0);
INSERT INTO `t_entryinfo` VALUES (3689, '2016-06-16', 'Ｒ＆Ｄ支部', 'やまむら　くんぺい', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03689.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3690, '2016-06-16', 'Ｒ＆Ｄ支部', 'あくつ　はるちか', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03690.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3691, '2016-06-16', 'Ｒ＆Ｄ支部', 'たかはし　りょうじ', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03691.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3692, '2016-06-16', 'Ｒ＆Ｄ支部', 'いしはら　れい', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03692.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3693, '2016-06-16', 'Ｒ＆Ｄ支部', 'やながわ　たいせい', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03693.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3694, '2016-06-16', 'Ｒ＆Ｄ支部', 'うえのはら　りょう', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03694.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3695, '2016-06-16', 'Ｒ＆Ｄ支部', 'やまじ　ゆい', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03695.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3696, '2016-06-16', '小山支部', '佐藤　愛作', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03696.jpeg', '', 'ヤマザクラと新緑の競演', '私の住んでいる茨城県に高峯山という里山がある。4月の中旬は山桜と新緑の織り成すパットワークはすばらしく、そんな風景を遠望し、一枚の写真に収めました。', 50.00, 59.00, 2.00, NULL, '307-0004', '茨城県結城市みどり町2-5-1', '0296-32-6885', '佐藤　愛作', 0);
INSERT INTO `t_entryinfo` VALUES (3697, '2016-06-16', 'Ｒ＆Ｄ支部', 'わたなべ　ここな', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03697.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3698, '2016-06-16', 'Ｒ＆Ｄ支部', 'うちだ　みさき', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03698.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3699, '2016-06-16', 'Ｒ＆Ｄ支部', 'いとう　あかり', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03699.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3700, '2016-06-16', 'Ｒ＆Ｄ支部', 'ひろた　ゆう', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03700.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3701, '2016-06-16', 'Ｒ＆Ｄ支部', 'くらはし　さら', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03701.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3702, '2016-06-16', 'Ｒ＆Ｄ支部', 'まるみね　なおたろう', NULL, NULL, NULL, NULL, 'C01', 'RI', '', NULL, 'img03702.jpeg', '', '家族', 'チャイルドケア・こすぎ　園児作品', 29.50, 21.00, 0.00, NULL, '211-0063', '川崎市中原区小杉町3-264-3', '044-733-4101', '佐藤　恵美子', 0);
INSERT INTO `t_entryinfo` VALUES (3703, '2016-06-16', '小山支部', '佐藤　信子', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03703.jpeg', '', '飛び立ちの前日', '「もう一度羽ばたきの練習するのよ!!」と優雅に羽を広げるパパ。「忙しい！忙しい！もう飛び立つ準備はOKかしら？」とガアガア　あわただしく叫びながら動きまわるママ。そんな飛び立ち前日のワンシーンをゲットしました。', 50.00, 59.00, 2.00, NULL, '307-0004', '茨城県結城市みどり町2-5-1', '0296-32-6885', '佐藤　信子', 0);
INSERT INTO `t_entryinfo` VALUES (3704, '2016-06-16', '小山支部', '今地　輝武', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03704.jpeg', '', 'ズミの花咲く光徳牧場', '初夏の日光、光徳牧場でスケッチしました。', 78.00, 90.00, 0.00, NULL, '323-0829', '栃木県小山市東城南2-30-12', '0285-28-6003', '今地　輝武', 0);
INSERT INTO `t_entryinfo` VALUES (3705, '2016-06-16', 'Ｒ＆Ｄ支部', '萩原　つね子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03705.jpeg', '', '料理がおいしく見えるだろう小鉢', 'たたら作りを利用して作りました', 30.00, 40.00, 30.00, NULL, '213-0026', '川崎市高津区久末1506-1-104', '044-754-1057', '萩原　つね子', 0);
INSERT INTO `t_entryinfo` VALUES (3706, '2016-06-16', '小山支部', '北條　博三郎', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03706.jpeg', '', '能登の巌門と機具岩', '能登半島の美しい海の浸食により、作り上げられた岩を表現しました。', 78.00, 90.00, 3.00, NULL, '329-0502', '栃木県下野市下古山1-7-1', '0285-53-4175', '北條　博三郎', 0);
INSERT INTO `t_entryinfo` VALUES (3707, '2016-06-16', 'Ｒ＆Ｄ支部', '松原　真紀', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03707.jpeg', '', 'おいしくお酒', '大好きな芋焼酎用に作成しました。', 30.00, 40.00, 30.00, NULL, '210-0844', '川崎市川崎区渡田新町2-7-8', '090-4820-6363', '松原　真紀', 0);
INSERT INTO `t_entryinfo` VALUES (3708, '2016-06-16', '小山支部', '高久　裕子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03708.jpeg', '', 'つまみ細工', '娘の成人式に何か愛情がこもった記念になるものをと考え、つまみ細工を習ってかんざしや帯飾り等を作成しました。\r\n娘に喜んでもらえ、一つの節目を迎えることが出来てホッとしました。', 0.00, 0.00, 0.00, NULL, '323-0806', '栃木県小山市中久喜1094-6', '0285-24-0234', '高久　裕子', 0);
INSERT INTO `t_entryinfo` VALUES (3709, '2016-06-16', '小山支部', '岩瀬　巌', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03709.jpeg', '', '方年末（青春の松）', '廃材と針金を利用し松の形に作成（手芸）したものです。', 60.00, 45.00, 45.00, NULL, '307-0001', '茨城県結城市結城2929-3', '0296-32-3172', '岩瀬　巌', 0);
INSERT INTO `t_entryinfo` VALUES (3710, '2016-06-16', 'Ｒ＆Ｄ支部', '木佐貫　千代', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03710.jpeg', '', '真夏', '梅雨を通り越し、夏よ来いという思いで作成しました。', 30.00, 40.00, 30.00, NULL, '213-0023', '神奈川県川崎市高津区子母口135-1　アメニティ森102', '090-4714-2829', '加賀谷　千代', 0);
INSERT INTO `t_entryinfo` VALUES (3711, '2016-06-16', '小山支部', '山川　清四郎', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03711.jpeg', '', '陽光', '窓の外の春の光を表現しました。', 57.00, 77.00, 1.50, NULL, '323-0812', '栃木県小山市土塔227-2', '0285-27-7405', '山川　清四郎', 0);
INSERT INTO `t_entryinfo` VALUES (3712, '2016-06-16', '小山支部', '菅原　俊生', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03712.jpeg', '', 'おもい川の釣番小屋', '冬寒の「おもい川釣番小屋」を描いてみました。', 50.00, 70.00, 5.00, NULL, '323-0820', '栃木県小山市西城南', '0285-28-1289', '菅原　俊生', 0);
INSERT INTO `t_entryinfo` VALUES (3713, '2016-06-16', 'Ｒ＆Ｄ支部', '小林　さえみ', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03713.jpeg', '', 'さしみ皿とはしおき', '魚の絵むずかしい', 30.00, 40.00, 30.00, NULL, '146-0092', '大田区下丸子3-22-15-103', '080-3554-4690', '小林　さえみ', 0);
INSERT INTO `t_entryinfo` VALUES (3714, '2016-06-16', '小山支部', '小川　光男', NULL, NULL, NULL, NULL, 'P01', 'RI', '', NULL, 'img03714.jpeg', '', '休日のキンダーガーデン', '友人の旅行話の中から、幼稚園の休日の一景を描いたものです。', 54.00, 66.00, 5.00, NULL, '329-4422', '栃木県下都賀郡大平町榎本735-3', '0282-43-6444', '小川　光男', 0);
INSERT INTO `t_entryinfo` VALUES (3715, '2016-06-16', 'Ｒ＆Ｄ支部', '諸角　文子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03715.jpeg', '', '和食皿', '和食の副菜を何種類か盛りつけるためのお皿です。', 30.00, 40.00, 30.00, NULL, '192-0045', '東京都八王子市大和田町4-20-1', '090-3698-1971', '諸角　文子', 0);
INSERT INTO `t_entryinfo` VALUES (3716, '2016-06-16', '小山支部', '谷口 亘璋', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03716.jpeg', '', '種田山頂火の句', '不要になった着物の裂を利用して、掛軸を作りました。書・軸装とも自作です。', 135.00, 40.00, 0.00, NULL, '307-0007', '茨城県結城市小田林2571-72', '0296-33-4193', '谷口 亘璋', 0);
INSERT INTO `t_entryinfo` VALUES (3717, '2016-06-16', 'Ｒ＆Ｄ支部', '内田　奈津枝', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03717.jpeg', '', '洗面ボール', '大きいものにチャレンジしました', 30.00, 40.00, 30.00, NULL, '192-0363', '八王子市別所1-87-5', '042-677-4010', '中村　奈津枝', 0);
INSERT INTO `t_entryinfo` VALUES (3718, '2016-06-16', '小山支部', '渡辺　綾子', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03718.jpeg', '', '山峰染月寒', '山深い峰に月が染まるのは寒い', 100.00, 30.00, 0.00, NULL, '329-0203', '栃木県小山市西黒田317-2', '0285-45-3680', '渡辺　佳子', 0);
INSERT INTO `t_entryinfo` VALUES (3719, '2016-06-16', 'Ｒ＆Ｄ支部', '上野　雅和', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03719.jpeg', '', '子どもと楽しむウォーターピッチャー', '子供たちと楽しいティータイムを過ごすために作りました。息子の好きな昔話に出てくる生き物を描きました。', 25.00, 20.00, 20.00, NULL, '411-0842', '静岡県三島市南町3-12', '080-3482-3807', '上野　雅和', 0);
INSERT INTO `t_entryinfo` VALUES (3720, '2016-06-16', 'Ｒ＆Ｄ支部', '石川　まり子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03720.jpeg', '', '呑兵衛のくつろぎ', 'ビールのお供にししゃもを載せてくつろぎたくて・・・', 30.00, 40.00, 30.00, NULL, '206-0803', '稲城市向陽台6-11　ビスタノーレ向陽台2-701', '090-9398-1545', '石川　まり子', 0);
INSERT INTO `t_entryinfo` VALUES (3721, '2016-06-16', 'Ｒ＆Ｄ支部', '坂本　美奈', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03721.jpeg', '', '四合わせ（しあわせ）のクローバー', 'ハート（心）を込めた手作りの和菓子をのせるために作りました。四つ合わせて四ツ葉のクローバー。食べる人にしあわせが訪れますように！', 30.00, 40.00, 30.00, NULL, '167-0054', '杉並区松庵1-10-24-101', '03-3247-8079', '坂本　美奈', 0);
INSERT INTO `t_entryinfo` VALUES (3722, '2016-06-16', 'Ｒ＆Ｄ支部', '菊池　園子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03722.jpeg', '', '初めての陶芸', '初めてやってみました。少し難しかった。能力の限界です。', 30.00, 40.00, 30.00, NULL, '252-0344', '相模原市南区古淵2-12-2-1408', '042-712-9190', '元芳　園子', 0);
INSERT INTO `t_entryinfo` VALUES (3723, '2016-06-16', 'Ｒ＆Ｄ支部', '畑中　清之', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03723.jpeg', '', '特売品！！', '葉っぱがなぜか魚になった・・・', 30.00, 40.00, 30.00, NULL, '211-0053', '神奈川県川崎市中原区上小田中1-25-22', '090-2244-3897', '畑中　清之', 0);
INSERT INTO `t_entryinfo` VALUES (3724, '2016-06-16', '小山支部', '渡辺　悟美', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03724.jpeg', '', '歓笑盡娯', '笑いが溢れ楽しみの限り尽くすこと', 35.00, 35.00, 0.00, NULL, '329-0203', '栃木県小山市西黒田317-2', '0285-45-3680', '渡辺　佳子', 0);
INSERT INTO `t_entryinfo` VALUES (3725, '2016-06-16', 'Ｒ＆Ｄ支部', '飯島　功次', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03725.jpeg', '', 'みんなで食べよう！', 'おかずを取り分ける事なく、家族みんなで食べられる大きなボウルを作りました。\r\nオーバル型にし、絵付けはシンプルにおしゃれなイメージで作ったつもりですが、出来上がりが楽しみです。', 30.00, 40.00, 30.00, NULL, '211-0041', '神奈川県川崎市中原区下小田中2-21-1-103　フラグレンス原', '090-1855-9231', '飯島　康子', 0);
INSERT INTO `t_entryinfo` VALUES (3726, '2016-06-16', 'Ｒ＆Ｄ支部', '岩崎　津奈己', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03726.jpeg', '', '無念無想', '初めての経験だったので「無念無想」で臨みました。デザインセンスがないので予定通りへポい柄になりました。', 30.00, 40.00, 30.00, NULL, '252-0302', '神奈川県相模原市南区上鶴間7-3-1-907', '042-853-5587', '岩崎　津奈己', 0);
INSERT INTO `t_entryinfo` VALUES (3727, '2016-06-16', 'Ｒ＆Ｄ支部', '遠藤　佳代', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03727.jpeg', '', 'オリエンタル', 'ユリの花と香りを楽しみながら一杯', 30.00, 40.00, 30.00, NULL, '213-0012', '神奈川県川崎市高津区坂戸3-19-19　セラン北山101', '044-833-3038', '遠藤　佳代', 0);
INSERT INTO `t_entryinfo` VALUES (3728, '2016-06-16', 'Ｒ＆Ｄ支部', '高田　理映', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03728.jpeg', '', '花瓶', '紫陽花にあう花瓶が欲しくて作製しました。', 30.00, 40.00, 30.00, NULL, '211-0051', '川崎市中原区宮内3-21-33-406', '044-798-3714', '高田　理映', 0);
INSERT INTO `t_entryinfo` VALUES (3729, '2016-06-16', 'Ｒ＆Ｄ支部', '佐藤　悦子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03729.jpeg', '', '菓子器', '茶席に出せる器を想像し、形を選び釉薬を決めました。あとは美味しい和菓子を作るだけです。', 30.00, 40.00, 30.00, NULL, '213-0014', '川崎市高津区新作5-15-25-203', '044-852-3575', '佐藤　悦子', 0);
INSERT INTO `t_entryinfo` VALUES (3730, '2016-06-16', 'Ｒ＆Ｄ支部', '佐藤　勝江', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03730.jpeg', '', '食卓', '初めての陶芸体験だったので、家族で使えるものを・・と思い作成してみました。', 30.00, 40.00, 30.00, NULL, '210-0844', '川崎市川崎区渡田新町2-3-16', '044-366-6577', '佐藤　勝江', 0);
INSERT INTO `t_entryinfo` VALUES (3731, '2016-06-16', 'Ｒ＆Ｄ支部', '相原　文明', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03731.jpeg', '', '植木鉢', '何を植えようか楽しみです。', 30.00, 40.00, 30.00, NULL, '190-0031', '立川市砂川町1-19-4', '042-537-6576', '相原　房子', 0);
INSERT INTO `t_entryinfo` VALUES (3732, '2016-06-16', 'Ｒ＆Ｄ支部', '鍋島　美樹', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03732.jpeg', '', '角皿ペア', '微妙に形を変えてみました。', 30.00, 40.00, 30.00, NULL, '252-0805', '藤沢市円行762', '0466-45-3384', '鍋島　美樹', 0);
INSERT INTO `t_entryinfo` VALUES (3733, '2016-06-16', '小山支部', '武部　千恵子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03733.jpeg', '', 'ベビードレス', 'かぎ針、初めての挑戦で編みました。', 100.00, 70.00, 0.00, NULL, '307-0001', '茨城県結城市結城11916-10', '0296-33-0383', '武部　千恵子', 0);
INSERT INTO `t_entryinfo` VALUES (3734, '2016-06-16', '小山支部', '三浦　敦子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03734.jpeg', '', 'パッチワーク　レッスンバッグ', '娘のピアノレッスン用に頑張って作りました。', 30.00, 40.00, 3.00, NULL, '323-0820', '栃木県小山市西城南3-8-23', '0285-28-0406', '三浦　敦子', 0);
INSERT INTO `t_entryinfo` VALUES (3735, '2016-06-16', '小山支部', '沼山　道子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03735.jpeg', '', 'アンサンブル', 'おしゃれしてパーティーに行きたいなぁ', 60.00, 50.00, 0.00, NULL, '306-0402', '茨城県猿島郡境町猿山273-7', '0280-87-4710', '沼山　道子', 0);
INSERT INTO `t_entryinfo` VALUES (3736, '2016-06-16', '小山支部', '皮籠石　久美子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03736.jpeg', '', 'パイナップル模様のチュニック', '本の中でかわいいパイナップル模様のチュニックがあったので夏に向けて編みました。', 65.00, 50.00, 0.00, NULL, '323-0829', '栃木県小山市東城南3-16-25', '0285-27-9858', '皮籠石　久美子', 0);
INSERT INTO `t_entryinfo` VALUES (3737, '2016-06-16', '小山支部', '木村　陽一', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03737.jpeg', '', '新緑を映す', '春の観音沼です。\r\n　参考　撮影地：福島県下郷町　', 50.00, 58.40, 2.20, NULL, '307-0001', '茨城県結城市結城1665-9', '0296-32-4784', '木村　陽一', 0);
INSERT INTO `t_entryinfo` VALUES (3738, '2016-06-16', 'Ｒ＆Ｄ支部', '中安　史朗', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03738.jpeg', '', 'ウミネコ', '空を自由に飛び回る「うみねこ」の様子を見ていると、その優雅さに圧倒されてしまい思わずカメラを向けたのがこの写真。', 0.00, 0.00, 0.00, NULL, '211-8588', '川崎市中原区上小田中4-1-1  富士通労働組合R&D支部', '044-754-2583', '本城　信行', 0);
INSERT INTO `t_entryinfo` VALUES (3739, '2016-06-16', 'Ｒ＆Ｄ支部', '矢澤　靖史', NULL, NULL, NULL, NULL, 'P03', 'RI', '', NULL, 'img03739.jpeg', '', '紅葉', '秋の京都。紅葉の名所として知られる東福寺を散策してみました。2,000本にも及ぶカエデの紅葉に圧倒され、しばらく足を止めて見入ってしまいました。そんな絶景を収めた一枚です。', 0.00, 0.00, 0.00, NULL, '211-8588', '川崎市中原区上小田中4-1-1　富士通労働組合R&D支部', '044-754-2583', '本城　信行', 0);
INSERT INTO `t_entryinfo` VALUES (3740, '2016-06-17', 'Ｒ＆Ｄ支部', '谷島　美紀子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03740.jpeg', '', 'ミニストールとベスト', '古い毛糸と新しい毛糸で作成してみました。', 90.00, 120.00, 0.00, NULL, '251-0011', '藤沢市渡内4-8-5', '0466-25-8163', '谷島　美紀子', 0);
INSERT INTO `t_entryinfo` VALUES (3741, '2016-06-16', '沼津支部', '小股 英樹', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03741.jpeg', '', '', '梅と富士山　（富士市の岩本山公園から撮影）', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3742, '2016-06-16', 'Ｒ＆Ｄ支部', '大類　誠一', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03742.jpeg', '', '蛇と魚', '生き物だよ', 10.00, 10.00, 10.00, NULL, '191-0012', '東京都日野市日野1111-1ニューロシティF-706', '042-584-7917', '大類　誠一', 0);
INSERT INTO `t_entryinfo` VALUES (3743, '2016-06-16', '沼津支部', '中村　久知', NULL, NULL, NULL, NULL, 'B01', 'RA', '', NULL, 'img03743.jpeg', '', '', '銀杏並木　（三島市文教町、学園通りから撮影）', 0.00, 0.00, 0.00, NULL, '', '', '', '', 0);
INSERT INTO `t_entryinfo` VALUES (3744, '2016-06-16', 'Ｒ＆Ｄ支部', '大類　奈美子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03744.jpeg', '', 'コップと皿', '', 15.00, 15.00, 15.00, NULL, '191-0012', '東京都日野市日野1111-1ニューロシティF-706', '042-584-7917', '大類　誠一', 0);
INSERT INTO `t_entryinfo` VALUES (3745, '2016-06-20', '沼津支部', '吉松　清庸', NULL, NULL, NULL, NULL, 'P02', 'RI', '', NULL, 'img03745.jpeg', '', '白砂青松', '全体のバランスと文字の流れを意識しながら作成しました。', 24.00, 33.00, 0.00, NULL, '4101123', '静岡県裾野市伊豆島田１２－１ ウィスティリア裾野708号室', '0559936707', '吉松　清庸', 0);
INSERT INTO `t_entryinfo` VALUES (3746, '2016-06-20', 'Ｒ＆Ｄ支部', '青木　美枝', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03746.jpeg', '', '茶道具の仕覆(ｼﾌｸ)', '小さな茶道具の一つ一つに袋を作り、持ち運べる様にコンパクトにまとめました。\r\n裂地(布)はアジアの更紗や日本の着物布を用いています。\r\n', 50.00, 40.00, 20.00, NULL, '226-0026', '横浜市緑区長津田町2326-1-403', '045-982-3448', '青木 美枝', 0);
INSERT INTO `t_entryinfo` VALUES (3747, '2016-06-20', 'Ｒ＆Ｄ支部', '青木　美津子', NULL, NULL, NULL, NULL, 'P04', 'RI', '', NULL, 'img03747.jpeg', '', '飾り結びバック', '飾り結びをアクセントにした和布の手提げバックです。結び目には不思議な力が宿ると言われておりお守り等に使われる結びです。', 40.00, 50.00, 10.00, NULL, '226-0026', '横浜市緑区長津田町2326-1-403', '045-982-3448', '青木 美枝', 0);

-- ----------------------------
-- Table structure for t_vote
-- ----------------------------
DROP TABLE IF EXISTS `t_vote`;
CREATE TABLE `t_vote`  (
  `E_ROWID` int(5) NOT NULL,
  `E_KBN_CODE` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `E_BM_CODE` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserID` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `VoteFlg` tinyint(1) NOT NULL,
  `VoteDate` datetime(0) NOT NULL,
  PRIMARY KEY (`E_ROWID`, `UserID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '���[�e�[�u��' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_vote
-- ----------------------------
INSERT INTO `t_vote` VALUES (3444, 'RA', 'B04', '051198', 0, '2016-06-21 17:22:03');
INSERT INTO `t_vote` VALUES (3444, 'RA', 'B04', '845409', 0, '2016-06-21 12:48:39');
INSERT INTO `t_vote` VALUES (3449, 'RA', 'B04', '743306', 0, '2016-06-21 16:00:11');
INSERT INTO `t_vote` VALUES (3456, 'RA', 'B04', '000022011', 0, '2016-06-21 16:35:57');
INSERT INTO `t_vote` VALUES (3459, 'RA', 'B01', '915688', 0, '2016-06-20 09:57:24');
INSERT INTO `t_vote` VALUES (3465, 'RA', 'B01', '512948', 0, '2016-06-20 08:47:18');
INSERT INTO `t_vote` VALUES (3473, 'RA', 'B01', '873955', 0, '2016-06-20 13:11:15');
INSERT INTO `t_vote` VALUES (3473, 'RA', 'B01', '931174', 0, '2016-06-21 13:07:19');
INSERT INTO `t_vote` VALUES (3474, 'RA', 'B01', '841884', 0, '2016-06-21 16:32:30');
INSERT INTO `t_vote` VALUES (3478, 'RA', 'B01', '924387', 0, '2016-06-20 11:36:45');
INSERT INTO `t_vote` VALUES (3487, 'RA', 'B01', '881010', 0, '2016-06-21 15:10:21');
INSERT INTO `t_vote` VALUES (3488, 'RA', 'B05', '352080', 0, '2016-06-20 13:50:41');
INSERT INTO `t_vote` VALUES (3488, 'RA', 'B05', '414069', 0, '2016-06-20 13:55:26');
INSERT INTO `t_vote` VALUES (3488, 'RA', 'B05', '512948', 0, '2016-06-20 08:49:04');
INSERT INTO `t_vote` VALUES (3488, 'RA', 'B05', '634793', 0, '2016-06-20 13:32:58');
INSERT INTO `t_vote` VALUES (3488, 'RA', 'B05', '931174', 0, '2016-06-21 13:08:23');
INSERT INTO `t_vote` VALUES (3491, 'RI', 'P04', '804012', 0, '2016-06-21 12:49:27');
INSERT INTO `t_vote` VALUES (3491, 'RI', 'P04', '842675', 0, '2016-06-20 11:10:20');
INSERT INTO `t_vote` VALUES (3495, 'RA', 'B03', '731149', 0, '2016-06-20 11:31:52');
INSERT INTO `t_vote` VALUES (3495, 'RA', 'B03', '881010', 0, '2016-06-21 15:10:54');
INSERT INTO `t_vote` VALUES (3496, 'RI', 'P03', '845422', 0, '2016-06-20 07:58:28');
INSERT INTO `t_vote` VALUES (3503, 'RI', 'P04', '881010', 0, '2016-06-21 15:08:59');
INSERT INTO `t_vote` VALUES (3506, 'RI', 'P03', '352080', 0, '2016-06-20 13:47:09');
INSERT INTO `t_vote` VALUES (3509, 'RA', 'B01', '743306', 0, '2016-06-21 15:49:28');
INSERT INTO `t_vote` VALUES (3510, 'RI', 'P02', '00822913', 0, '2016-06-20 08:59:02');
INSERT INTO `t_vote` VALUES (3510, 'RI', 'P02', '873955', 0, '2016-06-20 13:05:31');
INSERT INTO `t_vote` VALUES (3510, 'RI', 'P02', '915688', 0, '2016-06-20 09:49:39');
INSERT INTO `t_vote` VALUES (3511, 'RI', 'P03', '000022011', 0, '2016-06-21 16:32:56');
INSERT INTO `t_vote` VALUES (3511, 'RI', 'P03', '931262', 0, '2016-06-20 09:31:24');
INSERT INTO `t_vote` VALUES (3512, 'RI', 'P04', '873955', 0, '2016-06-20 13:09:18');
INSERT INTO `t_vote` VALUES (3516, 'RI', 'P03', '512948', 0, '2016-06-20 08:41:10');
INSERT INTO `t_vote` VALUES (3517, 'RA', 'B01', '352080', 0, '2016-06-21 08:56:19');
INSERT INTO `t_vote` VALUES (3518, 'RI', 'P02', '804012', 0, '2016-06-21 12:48:00');
INSERT INTO `t_vote` VALUES (3530, 'RI', 'P03', '743306', 0, '2016-06-21 15:20:00');
INSERT INTO `t_vote` VALUES (3530, 'RI', 'P03', '801069', 0, '2016-06-20 08:37:14');
INSERT INTO `t_vote` VALUES (3530, 'RI', 'P03', '804012', 0, '2016-06-21 12:48:59');
INSERT INTO `t_vote` VALUES (3530, 'RI', 'P03', '924387', 0, '2016-06-20 11:31:18');
INSERT INTO `t_vote` VALUES (3531, 'RI', 'P02', '924387', 0, '2016-06-20 11:28:55');
INSERT INTO `t_vote` VALUES (3532, 'RI', 'P03', '904695', 0, '2016-06-20 16:04:17');
INSERT INTO `t_vote` VALUES (3533, 'RI', 'P03', '051029', 0, '2016-06-21 11:52:27');
INSERT INTO `t_vote` VALUES (3533, 'RI', 'P03', '915688', 0, '2016-06-20 09:52:21');
INSERT INTO `t_vote` VALUES (3535, 'RI', 'P04', '090225', 0, '2016-06-21 12:22:20');
INSERT INTO `t_vote` VALUES (3535, 'RI', 'P04', '506419', 0, '2016-06-20 11:47:28');
INSERT INTO `t_vote` VALUES (3537, 'RA', 'B01', '845409', 0, '2016-06-21 12:44:46');
INSERT INTO `t_vote` VALUES (3537, 'RA', 'B01', '924722', 0, '2016-06-21 12:24:00');
INSERT INTO `t_vote` VALUES (3542, 'RI', 'P01', '432747', 0, '2016-06-20 09:52:20');
INSERT INTO `t_vote` VALUES (3542, 'RI', 'P01', '743306', 0, '2016-06-21 15:10:13');
INSERT INTO `t_vote` VALUES (3545, 'RI', 'P04', '731149', 0, '2016-06-20 11:29:17');
INSERT INTO `t_vote` VALUES (3546, 'RI', 'P01', '801069', 0, '2016-06-20 08:31:09');
INSERT INTO `t_vote` VALUES (3547, 'RI', 'P01', '000022011', 0, '2016-06-21 16:35:10');
INSERT INTO `t_vote` VALUES (3547, 'RI', 'P01', '850811', 0, '2016-06-20 12:38:41');
INSERT INTO `t_vote` VALUES (3547, 'RI', 'P01', '873955', 0, '2016-06-20 13:05:11');
INSERT INTO `t_vote` VALUES (3548, 'RI', 'P03', '931174', 0, '2016-06-21 13:04:00');
INSERT INTO `t_vote` VALUES (3549, 'RI', 'P04', '743306', 0, '2016-06-21 15:37:27');
INSERT INTO `t_vote` VALUES (3551, 'RI', 'P03', '091667', 0, '2016-06-20 08:44:11');
INSERT INTO `t_vote` VALUES (3554, 'RI', 'P04', '352080', 0, '2016-06-21 08:46:18');
INSERT INTO `t_vote` VALUES (3554, 'RI', 'P04', '423871', 0, '2016-06-21 14:07:27');
INSERT INTO `t_vote` VALUES (3554, 'RI', 'P04', '432743', 0, '2016-06-21 13:36:06');
INSERT INTO `t_vote` VALUES (3554, 'RI', 'P04', '502688', 0, '2016-06-21 12:04:40');
INSERT INTO `t_vote` VALUES (3561, 'RI', 'P04', '512948', 0, '2016-06-20 08:43:11');
INSERT INTO `t_vote` VALUES (3561, 'RI', 'P04', '801069', 0, '2016-06-20 08:37:49');
INSERT INTO `t_vote` VALUES (3561, 'RI', 'P04', '915688', 0, '2016-06-20 09:53:52');
INSERT INTO `t_vote` VALUES (3563, 'RI', 'P04', '051198', 0, '2016-06-21 17:17:56');
INSERT INTO `t_vote` VALUES (3564, 'RA', 'B04', '915688', 0, '2016-06-20 10:00:49');
INSERT INTO `t_vote` VALUES (3564, 'RA', 'B04', '925426', 0, '2016-06-21 08:28:23');
INSERT INTO `t_vote` VALUES (3574, 'RA', 'B01', '051198', 0, '2016-06-21 17:20:30');
INSERT INTO `t_vote` VALUES (3574, 'RA', 'B01', '731149', 0, '2016-06-20 11:30:34');
INSERT INTO `t_vote` VALUES (3574, 'RA', 'B01', '850811', 0, '2016-06-20 12:42:01');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '00090215', 0, '2016-06-21 12:57:43');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '00091193', 0, '2016-06-21 13:42:15');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '090130', 0, '2016-06-21 13:50:16');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '090186', 0, '2016-06-21 16:06:43');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '090219', 0, '2016-06-21 12:58:02');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '090225', 0, '2016-06-21 12:21:51');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091251', 0, '2016-06-21 13:35:27');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091271', 0, '2016-06-21 12:23:49');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091286', 0, '2016-06-21 14:07:27');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091376', 0, '2016-06-21 13:37:20');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091399', 0, '2016-06-21 13:23:54');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091436', 0, '2016-06-21 13:46:24');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091443', 0, '2016-06-21 13:49:01');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091548', 0, '2016-06-21 13:34:42');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '091662', 0, '2016-06-21 14:21:39');
INSERT INTO `t_vote` VALUES (3577, 'RI', 'P02', '850435', 0, '2016-06-21 14:21:22');
INSERT INTO `t_vote` VALUES (3586, 'RI', 'P04', '091548', 0, '2016-06-21 13:40:54');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '012300', 0, '2016-06-20 13:37:59');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '041027', 0, '2016-06-20 13:36:58');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '120155', 0, '2016-06-21 13:35:09');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '130171', 0, '2016-06-21 15:02:21');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '401796', 0, '2016-06-21 12:51:31');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '634792', 0, '2016-06-21 15:11:35');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '634793', 0, '2016-06-20 13:31:43');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '792177', 0, '2016-06-20 13:49:26');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '811697', 0, '2016-06-21 13:03:48');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '831839', 0, '2016-06-21 11:47:15');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '844316', 0, '2016-06-20 13:56:44');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '893103', 0, '2016-06-20 14:04:30');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '894527', 0, '2016-06-21 13:44:24');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '902128', 0, '2016-06-20 13:44:27');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '904695', 0, '2016-06-20 16:01:34');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '912222', 0, '2016-06-20 13:21:04');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '920363', 0, '2016-06-21 11:23:10');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', '921121', 0, '2016-06-20 13:50:11');
INSERT INTO `t_vote` VALUES (3587, 'RA', 'B02', 'fj151629', 0, '2016-06-21 13:36:58');
INSERT INTO `t_vote` VALUES (3588, 'RI', 'P02', '091667', 0, '2016-06-20 08:41:45');
INSERT INTO `t_vote` VALUES (3588, 'RI', 'P02', '801069', 0, '2016-06-20 08:33:50');
INSERT INTO `t_vote` VALUES (3588, 'RI', 'P02', '860715', 0, '2016-06-20 09:34:23');
INSERT INTO `t_vote` VALUES (3588, 'RI', 'P02', '925426', 0, '2016-06-21 08:28:49');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '00022011', 0, '2016-06-21 08:48:56');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '003070', 0, '2016-06-21 10:22:36');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '020144', 0, '2016-06-21 10:35:48');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '022036', 0, '2016-06-21 09:33:15');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '031232', 0, '2016-06-21 09:13:50');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '090259', 0, '2016-06-21 09:03:13');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '490500', 0, '2016-06-21 10:01:56');
INSERT INTO `t_vote` VALUES (3589, 'RA', 'B01', '910240', 0, '2016-06-21 10:08:15');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '00001084', 0, '2016-06-20 14:03:38');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '040067', 0, '2016-06-21 15:26:43');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '041169', 0, '2016-06-20 13:21:37');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '051198', 0, '2016-06-21 17:15:06');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '120151', 0, '2016-06-20 13:05:50');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '432747', 0, '2016-06-20 09:51:12');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '540895', 0, '2016-06-20 12:50:40');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '542442', 0, '2016-06-20 13:02:32');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '634793', 0, '2016-06-21 14:19:03');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '731149', 0, '2016-06-20 11:27:56');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '922127', 0, '2016-06-20 16:01:40');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '981183', 0, '2016-06-20 14:13:40');
INSERT INTO `t_vote` VALUES (3591, 'RI', 'P02', '981228', 0, '2016-06-21 08:14:57');
INSERT INTO `t_vote` VALUES (3597, 'RA', 'B01', '851732', 0, '2016-06-21 16:04:28');
INSERT INTO `t_vote` VALUES (3599, 'RI', 'P04', '000022011', 0, '2016-06-21 16:33:53');
INSERT INTO `t_vote` VALUES (3599, 'RI', 'P04', '925426', 0, '2016-06-21 08:30:03');
INSERT INTO `t_vote` VALUES (3600, 'RI', 'P01', '925426', 0, '2016-06-21 08:28:43');
INSERT INTO `t_vote` VALUES (3604, 'RI', 'P03', '925426', 0, '2016-06-21 08:29:42');
INSERT INTO `t_vote` VALUES (3607, 'RA', 'B01', '091548', 0, '2016-06-21 13:43:24');
INSERT INTO `t_vote` VALUES (3607, 'RA', 'B01', '925426', 0, '2016-06-21 08:28:02');
INSERT INTO `t_vote` VALUES (3609, 'RI', 'P03', '423871', 0, '2016-06-21 13:36:56');
INSERT INTO `t_vote` VALUES (3609, 'RI', 'P03', '432743', 0, '2016-06-21 13:35:45');
INSERT INTO `t_vote` VALUES (3609, 'RI', 'P03', '502688', 0, '2016-06-21 13:44:35');
INSERT INTO `t_vote` VALUES (3619, 'RI', 'P01', '00711857', 0, '2016-06-21 16:28:16');
INSERT INTO `t_vote` VALUES (3619, 'RI', 'P01', '00742214', 0, '2016-06-21 16:35:49');
INSERT INTO `t_vote` VALUES (3619, 'RI', 'P01', '00911252', 0, '2016-06-21 17:02:48');
INSERT INTO `t_vote` VALUES (3619, 'RI', 'P01', '804012', 0, '2016-06-21 12:47:32');
INSERT INTO `t_vote` VALUES (3619, 'RI', 'P01', '812573', 0, '2016-06-21 17:01:36');
INSERT INTO `t_vote` VALUES (3619, 'RI', 'P01', '848852', 0, '2016-06-21 16:46:59');
INSERT INTO `t_vote` VALUES (3620, 'RI', 'P01', '912281', 0, '2016-06-20 13:11:37');
INSERT INTO `t_vote` VALUES (3623, 'RI', 'P03', '906573', 0, '2016-06-21 09:15:49');
INSERT INTO `t_vote` VALUES (3624, 'RI', 'P01', '051198', 0, '2016-06-21 17:14:16');
INSERT INTO `t_vote` VALUES (3624, 'RI', 'P01', '915688', 0, '2016-06-20 09:47:54');
INSERT INTO `t_vote` VALUES (3626, 'RA', 'B01', '502688', 0, '2016-06-21 13:45:49');
INSERT INTO `t_vote` VALUES (3631, 'RA', 'B01', '920787', 0, '2016-06-20 10:05:31');
INSERT INTO `t_vote` VALUES (3634, 'RA', 'B01', '762059', 0, '2016-06-21 13:22:20');
INSERT INTO `t_vote` VALUES (3634, 'RA', 'B01', '842590', 0, '2016-06-21 13:33:15');
INSERT INTO `t_vote` VALUES (3634, 'RA', 'B01', '858160', 0, '2016-06-21 14:47:40');
INSERT INTO `t_vote` VALUES (3635, 'RA', 'B04', '866562', 0, '2016-06-20 09:15:23');
INSERT INTO `t_vote` VALUES (3635, 'RA', 'B04', '894200', 0, '2016-06-20 09:18:24');
INSERT INTO `t_vote` VALUES (3639, 'RA', 'B01', '091271', 0, '2016-06-21 12:25:17');
INSERT INTO `t_vote` VALUES (3640, 'RA', 'B03', '924387', 0, '2016-06-20 11:38:23');
INSERT INTO `t_vote` VALUES (3641, 'RA', 'B05', '091548', 0, '2016-06-21 13:44:03');
INSERT INTO `t_vote` VALUES (3641, 'RA', 'B05', '842675', 0, '2016-06-20 11:09:30');
INSERT INTO `t_vote` VALUES (3641, 'RA', 'B05', '871803', 0, '2016-06-20 10:39:05');
INSERT INTO `t_vote` VALUES (3647, 'RI', 'P04', '845409', 0, '2016-06-21 12:45:38');
INSERT INTO `t_vote` VALUES (3647, 'RI', 'P04', '922127', 0, '2016-06-20 16:08:58');
INSERT INTO `t_vote` VALUES (3647, 'RI', 'P04', '924387', 0, '2016-06-20 11:34:23');
INSERT INTO `t_vote` VALUES (3648, 'RI', 'P02', '845409', 0, '2016-06-21 12:45:59');
INSERT INTO `t_vote` VALUES (3649, 'RI', 'P03', '051198', 0, '2016-06-21 17:16:16');
INSERT INTO `t_vote` VALUES (3649, 'RI', 'P03', '731149', 0, '2016-06-20 11:28:33');
INSERT INTO `t_vote` VALUES (3656, 'RI', 'P03', '432747', 0, '2016-06-20 13:15:43');
INSERT INTO `t_vote` VALUES (3656, 'RI', 'P03', '922127', 0, '2016-06-20 16:06:05');
INSERT INTO `t_vote` VALUES (3659, 'RI', 'P04', '762059', 0, '2016-06-21 13:20:06');
INSERT INTO `t_vote` VALUES (3659, 'RI', 'P04', '842590', 0, '2016-06-21 13:27:52');
INSERT INTO `t_vote` VALUES (3659, 'RI', 'P04', '845422', 0, '2016-06-20 07:58:55');
INSERT INTO `t_vote` VALUES (3659, 'RI', 'P04', '858160', 0, '2016-06-21 14:48:37');
INSERT INTO `t_vote` VALUES (3660, 'RI', 'P01', '091667', 0, '2016-06-20 08:40:54');
INSERT INTO `t_vote` VALUES (3660, 'RI', 'P01', '352080', 0, '2016-06-21 08:40:22');
INSERT INTO `t_vote` VALUES (3660, 'RI', 'P01', '762059', 0, '2016-06-21 13:17:50');
INSERT INTO `t_vote` VALUES (3660, 'RI', 'P01', '842590', 0, '2016-06-21 13:23:14');
INSERT INTO `t_vote` VALUES (3660, 'RI', 'P01', '845409', 0, '2016-06-21 12:46:25');
INSERT INTO `t_vote` VALUES (3660, 'RI', 'P01', '858160', 0, '2016-06-21 14:48:07');
INSERT INTO `t_vote` VALUES (3662, 'RI', 'P03', '634793', 0, '2016-06-20 13:47:47');
INSERT INTO `t_vote` VALUES (3666, 'RI', 'P02', '762059', 0, '2016-06-21 13:18:50');
INSERT INTO `t_vote` VALUES (3666, 'RI', 'P02', '842590', 0, '2016-06-21 13:23:30');
INSERT INTO `t_vote` VALUES (3666, 'RI', 'P02', '858160', 0, '2016-06-21 14:48:17');
INSERT INTO `t_vote` VALUES (3685, 'RI', 'P02', '432743', 0, '2016-06-21 13:38:04');
INSERT INTO `t_vote` VALUES (3687, 'RI', 'P03', '762059', 0, '2016-06-21 13:19:21');
INSERT INTO `t_vote` VALUES (3687, 'RI', 'P03', '842590', 0, '2016-06-21 13:23:41');
INSERT INTO `t_vote` VALUES (3687, 'RI', 'P03', '858160', 0, '2016-06-21 14:47:28');
INSERT INTO `t_vote` VALUES (3704, 'RI', 'P01', '432743', 0, '2016-06-21 13:45:20');
INSERT INTO `t_vote` VALUES (3704, 'RI', 'P01', '922127', 0, '2016-06-20 15:59:34');
INSERT INTO `t_vote` VALUES (3704, 'RI', 'P01', '931262', 0, '2016-06-20 09:25:20');
INSERT INTO `t_vote` VALUES (3706, 'RI', 'P01', '091548', 0, '2016-06-21 13:38:58');
INSERT INTO `t_vote` VALUES (3706, 'RI', 'P01', '512948', 0, '2016-06-20 08:36:23');
INSERT INTO `t_vote` VALUES (3706, 'RI', 'P01', '920787', 0, '2016-06-20 10:03:27');
INSERT INTO `t_vote` VALUES (3706, 'RI', 'P01', '924387', 0, '2016-06-20 11:28:05');
INSERT INTO `t_vote` VALUES (3708, 'RI', 'P04', '931262', 0, '2016-06-20 09:36:46');
INSERT INTO `t_vote` VALUES (3713, 'RI', 'P04', '00822913', 0, '2016-06-20 08:58:22');
INSERT INTO `t_vote` VALUES (3713, 'RI', 'P04', '821308', 0, '2016-06-20 09:08:29');
INSERT INTO `t_vote` VALUES (3714, 'RI', 'P01', '731149', 0, '2016-06-20 11:26:57');
INSERT INTO `t_vote` VALUES (3714, 'RI', 'P01', '845422', 0, '2016-06-20 07:56:40');
INSERT INTO `t_vote` VALUES (3714, 'RI', 'P01', '931174', 0, '2016-06-21 12:59:35');
INSERT INTO `t_vote` VALUES (3716, 'RI', 'P02', '000022011', 0, '2016-06-21 16:34:39');
INSERT INTO `t_vote` VALUES (3716, 'RI', 'P02', '352080', 0, '2016-06-21 08:42:46');
INSERT INTO `t_vote` VALUES (3716, 'RI', 'P02', '931262', 0, '2016-06-20 09:26:51');
INSERT INTO `t_vote` VALUES (3718, 'RI', 'P02', '512948', 0, '2016-06-20 08:38:49');
INSERT INTO `t_vote` VALUES (3718, 'RI', 'P02', '743306', 0, '2016-06-21 15:12:10');
INSERT INTO `t_vote` VALUES (3718, 'RI', 'P02', '845422', 0, '2016-06-20 07:57:23');
INSERT INTO `t_vote` VALUES (3721, 'RI', 'P04', '931174', 0, '2016-06-21 13:05:02');
INSERT INTO `t_vote` VALUES (3724, 'RI', 'P02', '931174', 0, '2016-06-21 13:00:05');
INSERT INTO `t_vote` VALUES (3737, 'RI', 'P03', '040067', 0, '2016-06-21 15:27:27');
INSERT INTO `t_vote` VALUES (3737, 'RI', 'P03', '091548', 0, '2016-06-21 13:40:23');
INSERT INTO `t_vote` VALUES (3739, 'RI', 'P03', '845409', 0, '2016-06-21 12:47:45');
INSERT INTO `t_vote` VALUES (3743, 'RA', 'B01', '801069', 0, '2016-06-20 08:41:36');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '020144', 0, '2016-06-20 13:51:41');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '051092', 0, '2016-06-20 13:21:20');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '380731', 0, '2016-06-20 13:03:25');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '426201', 0, '2016-06-20 13:02:48');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '432748', 0, '2016-06-20 11:54:41');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '492983', 0, '2016-06-20 10:41:16');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '502689', 0, '2016-06-20 12:53:58');
INSERT INTO `t_vote` VALUES (3746, 'RI', 'P04', '912281', 0, '2016-06-20 13:44:06');
INSERT INTO `t_vote` VALUES (3747, 'RI', 'P04', '021271', 0, '2016-06-20 13:22:49');
INSERT INTO `t_vote` VALUES (3747, 'RI', 'P04', '432747', 0, '2016-06-20 09:49:37');

SET FOREIGN_KEY_CHECKS = 1;
