@font-face {
  font-family: " poppins/regular";
  src: url(./fonts/Poppins-Regular.ttf);
  font-weight: normal;
  font-style: normal;
}

* {
  margin: 0;
  padding: 0;
  font-family: "poppins/regular";
  font-weight: normal;
  font-style: normal;
  color: rgb(214, 211, 211);
}
section {
  max-width: 100vw;
  max-height: 100vh;
  display: flex;
  flex-direction: row;
  background: rgb(31, 31, 34);
}
::-webkit-scrollbar {
  width: 4px;
  background: transparent;
  border-radius: 8px;
}
::-webkit-scrollbar-thumb {
  background: grey;
  border-radius: 8px;
}
::-webkit-scrollbar-track {
  background: transparent;
}
.sectionHr {
  color: chartreuse;
}
#leftContainer {
  /* background: red; */
  flex: 0.8;
  display: flex;
  flex-direction: column;
}
#centerContainer {
  flex: 1.5;
}
#rightContainer {
  /* background: greenyellow; */
  flex: 2.3;
  overflow-y: scroll;
}
.inputsHolder {
  flex: 1;
  margin-top: 10px;
}
#statusHolder {
  background: gainsboro;
  flex: 9;
  overflow-y: scroll;
}
.inputs img {
  height: 50px;
  width: 50px;
  border-radius: 50%;
  object-fit: cover;
}
.inputs {
  display: flex;
  justify-content: space-around;
  align-items: center;
  margin-bottom: 10px;
}
.mystatus {
  padding-left: 10px;
}
.statusHr {
  width: 80%;
  margin-left: 20px;
  margin-bottom: 20px;
}
.statusContainer {
  box-sizing: border-box;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-basis: 255px;
  height: 60px;
  background: rgb(31, 31, 34);
  margin-left: 7px;
  margin-bottom: 10px;
  border: 1px solid grey;
  border-radius: 10px;
}
.statusContainer img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-left: 7px;
}
.statusContainer div {
  flex: 1;
  margin-left: 20px;
}
#input1 img {
  height: 30px;
  width: 30px;
}
#input2 img {
  height: 30px;
  width: 30px;
}
#input3 img {
  height: 30px;
  width: 30px;
}
#centerContainer {
  flex: 1;
  display: flex;
  flex-direction: column;
}
.chats {
  flex: 1;
  text-align: center;
  padding-top: 10px;
  margin-bottom: 10px;
}
.previuosChatsHolder {
  flex: 18;
  overflow-y: scroll;
  position: relative;
  display: flex;
}
#chatsContainer {
  flex-basis: 380px;
  height: 60px;
  background: rgb(31, 31, 34);
  margin-left: 10px;
  box-sizing: border-box;
  border: 1px solid grey;
  border-radius: 8px;
  margin-bottom: 11px;
  display: flex;
  /* align-items: center; */
  position: relative;
}
.chatsContainerim img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin: 5px 0 0 5px;
}
.chatsContainerim {
  flex: 1;
}
.chatsContainerAddOns {
  flex: 5;
  display: flex;
  flex-direction: column;
}
.nameanddate {
  flex: 1;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.nameanddate {
  margin-right: 5px;
}
.prevText {
  flex: 1;
  text-align: center;
  margin-top: 3px;
  font-size: 13px;
}
.newChat {
  padding: 1px 4px 1px 3px;
  border-radius: 50%;
  background: gray;
  position: absolute;
  left: 95%;
  top: 60%;
  font-size: 13px;
  text-align: center;
}
#rightContainer {
  display: flex;
  flex-direction: column;
}
.chatrightContainerHolder {
  flex: 12;
  display: flex;
  flex-direction: column;
}
.inputRightContainer {
  flex: 1;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.inputRightContainer img {
  height: 25px;
  flex-basis: 25px;
  margin-left: 20px;
}
#inputText {
  flex-basis: 700px;
  margin: 0 0 0 0;
  padding-left: 30px;
  border: none;
  background: inherit;
}
#inputText:focus {
  outline: none;
}
#submitMessage {
  flex-basis: 20px;
  padding: 5px 20px 5px 20px;
  margin-right: 20px;
  border-radius: 4px;
  border: 1px solid grey;
  background: inherit;
  cursor: pointer;
}
.chatrightContainerHolderHeader {
  flex: 1;
  display: flex;
  align-items: center;
}
.chatrightContainerHolderHeader img {
  flex-basis: 40px;
  height: 40px;
  border-radius: 50%;
  margin: 2px 10px 0 8px;
}
.chatrightContainerHolderMessages {
  flex: 12;
  display: flex;
  flex-direction: column;
  background: rgb(31, 31, 34);
  overflow-y: scroll;
}
.messageLeft {
  background: grey;
  height: 100px;
  flex-basis: 300px;
  border-radius: 8px;
  margin-left: 10px;
  margin-bottom: 15px;
  margin-right: auto;
}
.messageLeftDiv {
  display: flex;
}
.messageRight {
  background: rgb(179, 155, 155);
  height: 100px;
  flex-basis: 300px;
  border-radius: 8px;
  margin-bottom: 15px;
  margin-left: auto;
}
.messageRightDiv {
  display: flex;
}
#sendFileInput {
  cursor: pointer;
}
#toggleContents {
  position: absolute;
  top: 80%;
  left: 39%;
  background: gray;
  border-radius: 50%;
  height: 40px;
  width: 40px;
  padding: 5px 6px;
  z-index: 1;
  cursor: pointer;
}
#toggleStatus {
  display: none;  
  position: absolute;
  top: 90%;
  left: 39%;
  background: gray;
  border-radius: 50%;
  height: 40px;
  width: 40px;
  padding: 5px 6px;
  z-index: 1;
  cursor: pointer;
}
/* #toggleContents img{
    height: 40px;
    width: 40px;
    padding: 5px 6px ;

} */
#contactsContainer {
  flex-basis: 380px;
  height: 60px;
  background: rgb(31, 31, 34);
  margin-left: 10px;
  box-sizing: border-box;
  border: none;
  margin-bottom: 11px;
  display: none;
  justify-content: space-between;
  /* align-items: center; */
  position: relative;
}

#contactsContainer img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin: 5px 0 0 5px;
  margin-left: 8px;
}
.contactandStatus {
  flex: 1;
  margin-top: 9px;
  margin-left: 20px;
}
#contactsStatus {
  margin-top: 6px;
}
#addGroupIcon {
  display: none;
}

@media(max-width:900px){
    #leftContainer{
        flex: ;
    }
    #centerContainer{
        
    }
    #rightContainer{
        
    }
}