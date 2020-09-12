const functions = require("firebase-functions");
const request = require("request-promise");

const LINE_MESSAGING_API = "https://api.line.me/v2/bot/message";
const LINE_HEADER = {
  "Content-Type": "application/json",
  "Authorization": "Bearer <CHANNEL-ACCESS-TOKEN>"
};

exports.BasicMessage = functions.https.onRequest((req, res) => {
  return request({
    method: "POST",
    uri: `${LINE_MESSAGING_API}/push`,
    headers: LINE_HEADER,
    body: JSON.stringify({
      to: "<USER-ID>",
      messages: [{
        type: "sticker",
        packageId: 11537,
        stickerId: 52002744
      }]
    })
  }).then(() => {
      return res.status(200).send("Done");
  }).catch(error => {
      return Promise.reject(error);
  });
});
