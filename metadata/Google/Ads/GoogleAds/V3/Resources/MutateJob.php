<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v3/resources/mutate_job.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V3\Resources;

class MutateJob
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Protobuf\Wrappers::initOnce();
        \GPBMetadata\Google\Api\Http::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0ab6030a35676f6f676c652f6164732f676f6f676c656164732f76332f656e756d732f6d75746174655f6a6f625f7374617475732e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76332e656e756d73226a0a134d75746174654a6f62537461747573456e756d22530a0f4d75746174654a6f62537461747573120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e1001120b0a0750454e44494e471002120b0a0752554e4e494e47100312080a04444f4e45100442e9010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76332e656e756d7342144d75746174654a6f6253746174757350726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76332f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56332e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56335c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56333a3a456e756d73620670726f746f330ac00a0a32676f6f676c652f6164732f676f6f676c656164732f76332f7265736f75726365732f6d75746174655f6a6f622e70726f746f1221676f6f676c652e6164732e676f6f676c656164732e76332e7265736f75726365731a1f676f6f676c652f6170692f6669656c645f6265686176696f722e70726f746f1a19676f6f676c652f6170692f7265736f757263652e70726f746f1a1e676f6f676c652f70726f746f6275662f77726170706572732e70726f746f1a1c676f6f676c652f6170692f616e6e6f746174696f6e732e70726f746f22e6060a094d75746174654a6f6212410a0d7265736f757263655f6e616d65180120012809422ae04105fa41240a22676f6f676c656164732e676f6f676c65617069732e636f6d2f4d75746174654a6f62122c0a02696418022001280b321b2e676f6f676c652e70726f746f6275662e496e74363456616c75654203e0410312420a176e6578745f6164645f73657175656e63655f746f6b656e18032001280b321c2e676f6f676c652e70726f746f6275662e537472696e6756616c75654203e0410312550a086d6574616461746118042001280b323e2e676f6f676c652e6164732e676f6f676c656164732e76332e7265736f75726365732e4d75746174654a6f622e4d75746174654a6f624d657461646174614203e0410312570a0673746174757318052001280e32422e676f6f676c652e6164732e676f6f676c656164732e76332e656e756d732e4d75746174654a6f62537461747573456e756d2e4d75746174654a6f625374617475734203e0410312410a166c6f6e675f72756e6e696e675f6f7065726174696f6e18062001280b321c2e676f6f676c652e70726f746f6275662e537472696e6756616c75654203e041031ad9020a114d75746174654a6f624d65746164617461123d0a126372656174696f6e5f646174655f74696d6518012001280b321c2e676f6f676c652e70726f746f6275662e537472696e6756616c75654203e04103123f0a14636f6d706c6574696f6e5f646174655f74696d6518022001280b321c2e676f6f676c652e70726f746f6275662e537472696e6756616c75654203e0410312450a1a657374696d617465645f636f6d706c6574696f6e5f726174696f18032001280b321c2e676f6f676c652e70726f746f6275662e446f75626c6556616c75654203e0410312390a0f6f7065726174696f6e5f636f756e7418042001280b321b2e676f6f676c652e70726f746f6275662e496e74363456616c75654203e0410312420a1865786563757465645f6f7065726174696f6e5f636f756e7418052001280b321b2e676f6f676c652e70726f746f6275662e496e74363456616c75654203e041033a55ea41520a22676f6f676c656164732e676f6f676c65617069732e636f6d2f4d75746174654a6f62122c637573746f6d6572732f7b637573746f6d65727d2f6d75746174654a6f62732f7b6d75746174655f6a6f627d42fb010a25636f6d2e676f6f676c652e6164732e676f6f676c656164732e76332e7265736f7572636573420e4d75746174654a6f6250726f746f50015a4a676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76332f7265736f75726365733b7265736f7572636573a20203474141aa0221476f6f676c652e4164732e476f6f676c654164732e56332e5265736f7572636573ca0221476f6f676c655c4164735c476f6f676c654164735c56335c5265736f7572636573ea0225476f6f676c653a3a4164733a3a476f6f676c654164733a3a56333a3a5265736f7572636573620670726f746f33"
        ), true);
        static::$is_initialized = true;
    }
}

